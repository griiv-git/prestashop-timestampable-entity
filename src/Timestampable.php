<?php
/**
 * This file is part of the Symfony package.
 *
 * (c) Arnaud Scoté <arnaud@griiv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/


namespace Griiv\Prestashop\Timestampable;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait Timestampable
 *
 * @author Arnaud Scoté <arnaud@griiv.fr>
 */
trait Timestampable
{
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected ?\DateTime $dateAdd = null;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected \DateTime $dateUpd;

    /**
     * @return \DateTime
     */
    public function getDateAdd(): ?\DateTime
    {
        return $this->dateAdd;
    }

    /**
     * @param \DateTime $dateAdd
     *
     * @return self
     */
    public function setDateAdd(\DateTime $dateAdd): self
    {
        $this->dateAdd = $dateAdd;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpd(): \DateTime
    {
        return $this->dateUpd;
    }

    /**
     * @param \DateTime $dateUpd
     *
     * @return self
     */
    public function setDateUpd(\DateTime $dateUpd): self
    {
        $this->dateUpd = $dateUpd;
        return $this;
    }

    /**
     * Now we tell doctrine that before we persist or update we call the updatedTimestamps() function.
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setDateUpd(new \DateTime());

        if ($this->getDateAdd() === null) {
            $this->setDateAdd(new \DateTime());
        }
    }
}
