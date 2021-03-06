<?php


namespace vbpupil\Product;


use Vbpupil\Collection\Collection;
use vbpupil\Variation\SimpleVariation;

/**
 * Class Product
 * @package vbpupil\Product
 */
class Product
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var Collection
     */
    public $product_images, $descriptions,$variations;

    /**
     * @var bool
     */
    protected $live = false;

    /**
     * @var string
     */
    protected $slug = '';

    /**
     * @var bool
     */
    protected $featured = false;

    /**
     * @var bool
     */
    protected $best_seller = false;

    /**
     * @var bool
     */
    protected $new_product = false;

    /**
     * @var int
     */
    protected $id;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Collection $descriptions
     * @return Product
     */
    public function setDescriptions(Collection $descriptions): Product
    {
        $this->descriptions = $descriptions;
        return $this;
    }

    /**
     * @param Collection $product_images
     * @return Product
     */
    public function setProductImages(Collection $product_images): Product
    {
        $this->product_images = $product_images;
        return $this;
    }

    /**
     * @param Collection $variations
     * @throws \Exception
     */
    public function setVariations(Collection $variations): void
    {
        foreach ($variations->getItems() as $v) {
            if (!is_a($v, SimpleVariation::class)) {
                throw new \Exception('Incompatible type, must be/extend from SimpleVariation');
            }
        }

        $this->variations = $variations;
    }

    /**
     * @return bool
     */
    public function isLive(): bool
    {
        return $this->live;
    }

    /**
     * @param bool $live
     * @return Product
     */
    public function setLive(bool $live): Product
    {
        $this->live = $live;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return bool
     */
    public function isFeatured(): bool
    {
        return $this->featured;
    }

    /**
     * @param bool $featured
     */
    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    /**
     * @return bool
     */
    public function isBestSeller(): bool
    {
        return $this->best_seller;
    }

    /**
     * @param bool $best_seller
     */
    public function setBestSeller(bool $best_seller): void
    {
        $this->best_seller = $best_seller;
    }

    /**
     * @return bool
     */
    public function isNewProduct(): bool
    {
        return $this->new_product;
    }

    /**
     * @param bool $new_product
     */
    public function setNewProduct(bool $new_product): void
    {
        $this->new_product = $new_product;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }


}