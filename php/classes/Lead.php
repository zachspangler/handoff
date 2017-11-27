leadId BINARY(16) NOT NULL,
leadCompanyId BINARY(16) NOT NULL,
leadLeadSource BINARY(16) NOT NULL,
leadContactEmail VARCHAR(128),
leadContactName VARCHAR(64) NOT NULL,
leadContactPhone VARCHAR(32),
leadDateTime DATETIME(6) NOT NULL,
leadName VARCHAR(128),
leadSalesForceId VARCHAR(255),
leadSoldAmount DECIMAL(9,2),
leadStatus VARCHAR(64),

<?php

namespace Edu\Cnm\Handoff;
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Handoff Action List
 *
 * This is the lead source information stored for each company
 *
 * @author Zach Spangler <zaspangler@gmail.com> and Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 1.0.0
 **/
class Lead implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for this lead source identifier; this is the primary key
	 * @var Uuid $leadHandoffId
	 **/
	private $leadHandoffId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadHandoffLeadId
	 **/
	private $leadHandoffLeadId;
	/**
	 * id used to associate this profile with the correct company; this is the foreign key
	 * @var Uuid $leadHandoffGiverProfileId
	 **/
	private $leadHandoffGiverProfileId;