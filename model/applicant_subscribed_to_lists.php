<?php

/**
 * This class represents the selections for mailing lists.
 */
class Applicant_SubscribedToLists extends Applicant
{
    private array $_selectionsJobs;
    private array $_selectionsVerticals;

    /**
     * @return array
     */
    public function getSelectionsJobs(): array
    {
        return $this->_selectionsJobs;
    }

    /**
     * @param array $selectionsJobs
     */
    public function setSelectionsJobs(array $selectionsJobs): void
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    /**
     * @return array
     */
    public function getSelectionsVerticals(): array
    {
        return $this->_selectionsVerticals;
    }

    /**
     * @param array $selectionsVerticals
     */
    public function setSelectionsVerticals(array $selectionsVerticals): void
    {
        $this->_selectionsVerticals = $selectionsVerticals;
    }

}