<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Http\Requests\API\CustomerRegistrationRequests;
use App\Models\UserProfile;
use App\Traits\ApiResponse;
use App\Transformers\Customers\UserTransformer;
use App\User;
use Illuminate\Http\Request;

class CustomersController extends AbstractAPIController {
    use ApiResponse;

    public function all(Request $request)
    {
//        if ($request->user()->id !== (int)$userId) {
//            return $this->responseUnauthorized();
//        }

        // Get filters
        $filters = $this->getFilters($request, User::$filterables);

        // Create query
        $model = User::where('user_group_id', 5)->getQuery();
        $paginator = $this->filter($model, $filters);

        // Transform Result
        $result = $this->transformCollection($paginator, new UserTransformer);

        // Return response
        return $this->responseOk($result->toArray());
    }

    /**
     * Create a new customer
     *
     * @param CustomerRegistrationRequests $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerRegistrationRequests $request)
    {
        $result = null;
        \DB::transaction(function() use ($request, &$result) {
            $input = $request->except('image');

            $image = null;
            if ($request->has('image')) {
               $image =  $request->file('image')->store('users', 's3');
            }

            // Create a new user
            $result = User::create([
                'account_id'    => uniqid(), // TODO: Create correctly formatted account id
                'user_group'    => 'customer',
                'email'         => $input['email'],
                'password'      => bcrypt($input['password']),
                'account_type'  => 'individual',
                'login_type'    => 'email',
                'can_use_api'   => 0
            ]);

            // Create User Profile
            $result->profile()->create([
                'first_name'    => $input['first_name'],
                'last_name'     => $input['last_name'],
                'middle_name'   => isset($input['middle_name']) ? $input['middle_name'] : '',
                'gender'        => isset($input['gender']) ? $input['gender'] : 'male',
                'birthdate'     => isset($input['birthdate']) ? $input['birthdate'] : null,
                'image'         => $image
            ]);

            // Check if there is an image associated with this new user
            if ($request->has('image')) {
                if (isset($input['image']['id'])) {

                    // Update Image Resource
                    // TODO: Create Image Model
                }
            }
        });

        // Check if new customer was created
        if (! $result) {
            return $this->responseBadRequest(['something went wrong when creating a new customer']);
        }

        // Transform Result
        $result = $this->transformItem($result, new UserTransformer);

        return $this->responseCreated($result->toArray());
    }

    /**
     * Update user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $userId)
    {
        $user = $request->user();

        if (! $user) {
            return $this->responseUnauthorized();
        }

        if ($user->id != $userId) {
            return $this->responseUnauthorized();
        }

        $result = null;
        \DB::transaction(function() use ($request, &$result, $userId) {
            $input = $request->except('image');

            $image = null;
            if ($request->hasFile('image')) {
                if (getenv('APP_ENV') === 'production') {
                    $image =  $request->file('image')->store('prod/users', 's3');
                } else {
                    $image =  $request->file('image')->store('dev/users', 's3');
                }
            }

            $result = User::find($userId);
            // Change password
            if (isset($input['password'])) {
                $result->update([
                    'password'      => bcrypt($input['password']),
                ]);
            }

            // Create User Profile
            $profile = [
                'first_name'    => isset($input['first_name']) ? $input['first_name'] : $result->profile->first_name,
                'last_name'     => isset($input['last_name']) ? $input['last_name'] : $result->profile->last_name,
                'middle_name'   => isset($input['middle_name']) ? $input['middle_name'] : $result->profile->middle_name,
                'gender'        => isset($input['gender']) ? $input['gender'] : $result->profile->gender,
                'birthdate'     => isset($input['birthdate']) ? $input['birthdate'] : $result->profile->birthdate
            ];

            if ($image) {
                $profile['image'] = $image;
            }

            UserProfile::where('user_id', $result->id)
                ->update($profile);

            $result = User::find($userId);
        });

        // Check if new customer was created
        if (! $result) {
            return $this->responseBadRequest(['something went wrong when creating a new customer']);
        }

        // Transform Result
        $result = $this->transformItem($result, new UserTransformer);

        return $this->responseCreated($result->toArray());
    }

    /**
     * Get a user profile
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $userId)
    {
        $user = $request->user();

        if (! $user) {
            return $this->responseUnauthorized();
        }

        if ($userId !== 'me') {
            if ($user->id !== (int) $userId) {
                return $this->responseUnauthorized();
            }
        } else {
            $userId = $request->user()->id;
        }

        $result = User::find($userId);

        if (! $result) {
            return $this->responseNotFound();
        }

        // Transform result
        $result = $this->transformItem($result, new UserTransformer);

        return $this->responseOk($result->toArray());
    }
}