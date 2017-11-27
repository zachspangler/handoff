<?php

namespace Edu\Cnm\Handoff;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Handoff Sales Role
 *
 * This is the sales role information stored for each company
 *
 * @author Zach Spangler <zaspangler@gmail.com> and Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 1.0.0
 **/
class SalesRole implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for this sales role identifier; this is the primary key
	 * @var Uuid $salesRoleId
	 **/
	private $salesRoleId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadSourceCompanyId
	 **/
	private $salesRoleCompanyId;
	/**
	 * sales Role name which will be defined by the user
	 * @var string $salesRoleName
	 **/
	private $salesRoleName;
	/**
	 * sales Role type will be defined by our team and selected from a dropdown
	 * @var string $salesRoleType
	 **/
	private $salesRoleType;
	/**
	 * constructor for the Sales Role
	 *
	 * @param Uuid|string $newSalesRoleId id for this sales role identifier; this is the primary key
	 * @param Uuid|string $newSalesRoleCompanyId id of this company
	 * @param string $newSalesRoleName
	 * @param string $newSalesRoleType
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newSalesRoleId, $newSalesRoleCompanyId, string $newSalesRoleName, string $newSalesRoleType) {
		try {
			$this->setSalesRoleId($newSalesRoleId);
			$this->setSalesRoleCompanyId($newSalesRoleCompanyId);
			$this->setSalesRoleName($newSalesRoleName);
			$this->setSalesRoleType($newSalesRoleType);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for sales role id
	 *
	 * @return Uuid value of sales role id (or null if new Profile)
	 **/
	public function getSalesRoleId(): Uuid {
		return ($this->salesRoleId);
	}
	/**
	 * mutator method for sales role id
	 *
	 * @param  Uuid| string $newSalesRoleId value of new role id
	 * @throws \RangeException if $newSalesRoleId is not positive
	 * @throws \TypeError if the $newSalesRoleId is not
	 **/
	public function setSalesRoleId($newSalesRoleId): void {
		try {
			$uuid = self::validateUuid($newSalesRoleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->salesRoleId = $uuid;
	}
	/**
	 * accessor method for sales role company id
	 *
	 * @return Uuid value of sales role company id (or null if new Profile)
	 **/
	public function getSalesRoleCompanyId(): Uuid {
		return ($this->salesRoleCompanyId);
	}
	/**
	 * mutator method for sales role company id
	 *
	 * @param  Uuid| string $newSalesRoleId value of new role id
	 * @throws \RangeException if $newSalesRoleCompanyId is not positive
	 * @throws \TypeError if the $newSalesRoleCompanyId is not
	 **/
	public function setSalesRoleCompanyId($newSalesRoleCompanyId): void {
		try {
			$uuid = self::validateUuid($newSalesRoleCompanyId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the profile id
		$this->salesRoleCompanyId = $uuid;
	}

	/**
 * accessor method for salesRoleName
 *
 * @return string value of the salesRoleName
 */
	public function getSalesRoleName(): string {
		return ($this->salesRoleName);
	}
	/**
	 * mutator method for salesRoleName
	 *
	 * @param string $newSalesRoleName
	 * @throws \InvalidArgumentException  if the input is not a string or insecure
	 * @throws \RangeException if the input is not exactly 64 characters
	 * @throws \TypeError if the input is not a string
	 */
	public function setSalesRoleName(string $newSalesRoleName): void {
		if($newSalesRoleName  === null) {
			$this->salesRoleName = null;
			return;
		}
		$newSalesRoleName = strtolower(trim($newSalesRoleName));
		if(ctype_xdigit($newSalesRoleName) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 64 characters
		if(strlen($newSalesRoleName) !== 64) {
			throw(new\RangeException("sales role name must be less than 64 characters"));
		}
		$this->salesRoleName = $newSalesRoleName;
	}
	/**
	 * accessor method for salesRoleType
	 *
	 * @return string value of the salesRoleType
	 */
	public function getSalesRoleType(): string {
		return ($this->salesRoleType);
	}
	/**
	 * mutator method for salesRoleType
	 *
	 * @param string $newSalesRoleType
	 * @throws \InvalidArgumentException  if the input is not a string or insecure
	 * @throws \RangeException if the input is not exactly 64 characters
	 * @throws \TypeError if the input is not a string
	 */
	public function setSalesRoleType(string $newSalesRoleType): void {
		if($newSalesRoleType  === null) {
			$this->salesRoleType = null;
			return;
		}
		$newSalesRoleType = strtolower(trim($newSalesRoleType));
		if(ctype_xdigit($newSalesRoleType) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 64 characters
		if(strlen($newSalesRoleType) !== 64) {
			throw(new\RangeException("sales role type must be less than 64 characters"));
		}
		$this->salesRoleType = $newSalesRoleType;
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["salesRoleId"] = $this->salesRoleId->toString();
		$fields["salesRoleCompanyId"] = $this->salesRoleCompanyId->toString();
		return ($fields);
	}
}