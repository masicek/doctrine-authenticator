<?php

declare(strict_types=1);

namespace ADT\DoctrineAuthenticator;

use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="session", indexes={@Index(name="token_validUntil_idx", fields={"token", "validUntil"})})
 */
#[Entity]
#[Table(name: "session")]
#[Index(name: "token_validUntil_idx", fields: ["token", "validUntil"])]
class StorageEntity
{
	/**
	 * @Id
	 * @Column
	 * @GeneratedValue
	 */
	#[Id]
	#[Column]
	#[GeneratedValue]
	protected ?int $id;

	/** @Column */
	#[Column]
	protected DateTimeImmutable $createdAt;

	/** @Column(length=32) */
	#[Column(length: 32)]
	protected string $objectId;

	/** @Column(length=32) */
	#[Column(length: 32)]
	protected string $token;

	/** @Column */
	#[Column]
	protected DateTimeImmutable $validUntil;

	/** @Column(nullable=true) */
	#[Column(nullable: true)]
	protected ?DateTimeImmutable $regeneratedAt = null;

	/** @Column(length=15, nullable=true) */
	#[Column(length: 15, nullable: true)]
	protected ?string $ip = null;

	/** @Column(nullable=true) */
	#[Column(nullable: true)]
	protected ?string $userAgent = null;

	/** @Column(nullable=false, options={"default":false}) */
	#[Column(nullable: false, options: ["default" => false])]
	protected bool $isFraudDetected = false;

	public function __construct($objectId, string $token)
	{
		$this->createdAt = new DateTimeImmutable();
		$this->objectId = $objectId;
		$this->token = $token;
	}

	public function getObjectId(): string
	{
		return $this->objectId;
	}

	public function getToken(): string
	{
		return $this->token;
	}

	public function setToken(string $token): self
	{
		$this->token = $token;
		return $this;
	}

	public function getValidUntil(): ?DateTimeImmutable
	{
		return $this->validUntil;
	}

	public function setValidUntil(DateTimeImmutable $validUntil): self
	{
		$this->validUntil = $validUntil;
		return $this;
	}

	public function getRegeneratedAt(): ?DateTimeImmutable
	{
		return $this->regeneratedAt;
	}

	public function setRegeneratedAt(?DateTimeImmutable $regeneratedAt): self
	{
		$this->regeneratedAt = $regeneratedAt;
		return $this;
	}

	public function getIp(): ?string
	{
		return $this->ip;
	}

	public function setIp(?string $ip): self
	{
		$this->ip = $ip;
		return $this;
	}

	public function getUserAgent(): ?string
	{
		return $this->userAgent;
	}

	public function setUserAgent(?string $userAgent): self
	{
		$this->userAgent = $userAgent;
		return $this;
	}

	public function getIsFraudDetected(): bool
	{
		return $this->isFraudDetected;
	}

	public function setIsFraudDetected(bool $isFraudDetected): self
	{
		$this->isFraudDetected = $isFraudDetected;
		return $this;
	}
}
