<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserBall implements Rule
{
    private $x;
    private $machineBallsCount;
    private $userBallsCount;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($machineBallsCount, $userBallsCount)
    {
        $this->machineBallsCount = $machineBallsCount;
        $this->userBallsCount = $userBallsCount;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = array_map('intval', explode(',', $value));
        $uniqueValue = array_unique($value);
        $zeroExist = in_array(0, $value);

        if (count($value) !== count($uniqueValue) || $zeroExist
                || max($value) > $this->machineBallsCount
                || count($value) !== $this->userBallsCount) {
        }else {
            return $value;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose correct values!!!';
    }
}
