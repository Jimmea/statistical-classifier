<?php

/**
 * This file is part of the Statistical Classifier package.
 *
 * (c) Cam Spiers <camspiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Camspiers\StatisticalClassifier\Index;

use Camspiers\StatisticalClassifier\DataSource\DataSourceInterface;
use Camspiers\StatisticalClassifier\DataSource\DataArray;

use RuntimeException;

/**
 * @author Cam Spiers <camspiers@gmail.com>
 * @package Statistical Classifier
 */
class Index implements IndexInterface
{
    protected $prepared = false;
    protected $dataSource;
    protected $partitions = array();

    public function __construct(DataSourceInterface $dataSource = null)
    {
        $this->dataSource = $dataSource instanceof DataSourceInterface ? $dataSource : new DataArray();
    }

    public function isPrepared()
    {
        return $this->prepared;
    }

    public function setPrepared($prepared)
    {
        $this->prepared = (boolean) $prepared;
    }

    public function setDataSource(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    public function getDataSource()
    {
        return $this->dataSource;
    }

    public function getPartition($partitionName)
    {
        if (!isset($this->partitions[$partitionName])) {
            throw new RuntimeException(sprintf('The index partition \'%s\' does not exist', $partitionName));
        }

        return $this->partitions[$partitionName];
    }

    public function setPartition($partitionName, $partition)
    {
        $this->partitions[$partitionName] = $partition;
    }

    public function removePartition($partitionName)
    {
        if (isset($this->partitions[$partitionName])) {
            unset($this->partitions[$partitionName]);
        }
    }

    public function getPartitions()
    {
        return array_keys($this->partitions);
    }
}