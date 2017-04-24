<?php
namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Api\AbstractAPIController;
use App\Http\Requests\API\CustomerRegistrationRequests;
use App\Traits\ApiResponse;
use App\Transformers\Customers\UserTransformer;
use App\User;
use Illuminate\Http\Request;

class CustomersController extends AbstractAPIController {
    use ApiResponse;

    /**
     * Create a new customer
     *
     * @param CustomerRegistrationRequests $requests
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerRegistrationRequests $requests)
    {
        $result = null;
        \DB::transaction(function() use ($requests, &$result) {
            $input = $requests->except('image');

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
                'first_name' => $input['first_name'],
                'last_name'  => $input['last_name'],
                'middle_name'   => isset($input['middle_name']) ? $input['middle_name'] : '',
                'gender'        => isset($input['gender']) ? $input['gender'] : 'male',
                'birthdate'  => isset($input['birthdate']) ? $input['birthdate'] : null
            ]);

            // Check if there is an image associated with this new user
            if ($requests->has('image')) {
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

        if ($user->id !== (int) $userId) {
            return $this->responseUnauthorized();
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