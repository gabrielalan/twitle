<?php
namespace Twitle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="entries")
 */
class Entry
{
	/**
	 * @ORM\Id @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 * @var integer
	 */
	protected $id;
	/**
	 * @ORM\Column(type="string", length=140)
	 *
	 * @var string
	 */
	public $text;
	/**
	 * @ORM\Column(type="string", length=150, nullable=true)
	 *
	 * @var string
	 */
	public $author;

	public function getAuthor() {
		return $this->author;
	}
	
	public function setAuthor($author) {
		return $this->author = filter_var($author, FILTER_SANITIZE_STRING);
	}

	public function getText() {
		return $this->text;
	}
	
	public function setText($text) {
		return $this->text = filter_var($text, FILTER_SANITIZE_STRING);
	}

	public function getId() {
		return $this->id;
	}

	public static function loadValidatorMetadata(ClassMetadata $metadata) {
		$metadata->addPropertyConstraint('text', new Assert\NotBlank());
		$metadata->addPropertyConstraint('text', new Assert\Length(['min' => 5, 'max' => 140]));
	}
}