<?php
// HEADER

namespace Hostnet\Component\AccessorGenerator\Generator\fixtures\Generated;

use Doctrine\ORM\Mapping as ORM;
use Hostnet\Component\AccessorGenerator\Annotation as AG;
use Hostnet\Component\AccessorGenerator\Collection\ImmutableCollection;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\FeatureInterface;
use Hostnet\Component\AccessorGenerator\Generator\fixtures\Software;

trait SoftwareMethodsTrait
{
    /**
     * Get features
     *
     * @return \Hostnet\Component\AccessorGenerator\Generator\fixtures\FeatureInterface[]
     * @return \Hostnet\Component\AccessorGenerator\Collection\ConstCollectionInterface
     * @throws \InvalidArgumentException
     */
    public function getFeatures()
    {
        if (func_num_args() > 0) {
            throw new \BadMethodCallException(
                sprintf(
                    'getFeatures() has no arguments but %d given.',
                    func_num_args()
                )
            );
        }

        if ($this->features === null) {
            $this->features = new \Doctrine\Common\Collections\ArrayCollection();
        }

        return new ImmutableCollection($this->features);
    }

    /**
     * Add feature
     *
     * @param FeatureInterface $feature
     * @return Software
     * @throws \BadMethodCallException if the number of arguments is not correct
     */
    public function addFeature(FeatureInterface $feature)
    {
        if (func_num_args() != 1) {
            throw new \BadMethodCallException(
                sprintf(
                    'addFeatures() has one argument but %d given.',
                    func_num_args()
                )
            );
        }

        if ($this->features === null) {
            $this->features = new \Doctrine\Common\Collections\ArrayCollection();
        } elseif ($this->features->contains($feature)) {
            return $this;
        }

        $this->features->add($feature);
        $method = new \ReflectionMethod($feature, 'setSoftware');
        $method->setAccessible(true);
        $method->invoke($feature, $this);
        $method->setAccessible(false);
        return $this;
    }

    /**
     * Remove feature
     *
     * @param FeatureInterface $feature
     * @return Software
     * @throws \BadMethodCallException if the number of arguments is not correct
     */
    public function removeFeature(FeatureInterface $feature)
    {
        if (func_num_args() != 1) {
            throw new \BadMethodCallException(
                sprintf(
                    'removeFeatures() has one argument but %d given.',
                    func_num_args()
                )
            );
        }

        if (! $this->features instanceof \Doctrine\Common\Collections\Collection
            || ! $this->features->contains($feature)
        ) {
            return $this;
        }

        $this->features->removeElement($feature);

        $method = new \ReflectionMethod($feature, 'setSoftware');
        $method->setAccessible(true);
        $method->invoke($feature, null);
        $method->setAccessible(false);
        return $this;
    }
}
