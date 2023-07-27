<?php

namespace App\Validation;
use Respect\Validation\Factory;
use Respect\Validation\Exceptions\NestedValidationException;

Factory::setDefaultInstance(
    (new Factory())
        ->withRuleNamespace('App\\Validation\\Rules')
        ->withExceptionNamespace('App\\Validation\\Exceptions')
);

class Validator
{
	protected $errors;

	public function validate($request, array $rules)
	{
		foreach ($rules as $field => $rule) {
			try {
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			} catch (NestedValidationException $e) {
				$this->errors[$field] = $e->getMessages();
				$_SESSION['errors'] = $this->errors;
			}
		}

		return $this;
	}

	public function failed()
	{
		return !empty($this->errors);
	}
}