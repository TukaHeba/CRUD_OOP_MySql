<?php
trait Validator
{
    // Array to store validation errors
    private $errors = [];

    // ======> Sanitize the input method <====== //
    // This method will trimming whitespace, stripping slashes, and prevent XSS
    public function test_input(string $data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    // ======> Check if there are any validation errors <====== //
    public function passes(): bool
    {
        return empty($this->errors);
    }

    // ======> Retrieve the list of validation errors <====== //
    public function getErrors(): array
    {
        return $this->errors;
    }

    // ======> Clear the validation errors array <====== //
    public function clearErrors()
    {
        $this->errors = [];
        return $this;
    }

    // ======> Validate that the input is a non-empty string <====== //
    public function isText($input, $fieldName, $customMessage = null)
    {
        if (!is_string($input) || empty($input)) {
            $message = $customMessage ?? ucfirst($fieldName) . ' must be a valid string.';
            $this->errors[$fieldName] = $message;
        }
        return $this;
    }

    // ======> Validate that the input is a valid email address <====== //
    // public function isEmail($email, $fieldName, $customMessage = null)
    // {
    //     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //         $message = $customMessage ?? ucfirst($fieldName) . ' must be a valid email address.';
    //         $this->errors[$fieldName] = $message;
    //     }
    //     return $this;
    // }

    // ======> Validate the length of the input <====== //
    public function inputLength($input, $fieldName, $minLength, $maxLength = null, $customMessage = null)
    {
        $length = strlen($input);

        if ($length < $minLength) {
            $message = $customMessage ?? ucfirst($fieldName) . " must be at least $minLength characters long.";
            $this->errors[$fieldName] = $message;
        } elseif ($maxLength !== null && $length > $maxLength) {
            $message = $customMessage ?? ucfirst($fieldName) . " must be less than $maxLength characters long.";
            $this->errors[$fieldName] = $message;
        }
        return $this;
    }
}
