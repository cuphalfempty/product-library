<?php


namespace vbpupil\Variation;



use vbpupil\Exception\InvalidVariationSetupException;
use vbpupil\Price\PriceInterface;
use vbpupil\Variation\Validation\PriceValidationTrait;

/**
 * Class SimpleVariation
 * @package vbpupil\Product
 */
class SimpleVariation
{
    use PriceValidationTrait;

    /**
     * @var array
     */
    protected $required = ['productCode', 'title'];

    /**
     * @var string
     */
    protected $productCode;
    /**
     * @var string
     */
    protected $title;

    /**
     * @var PriceInterface
     */
    protected $price;


    /**
     * SimpleVariation constructor.
     * @param array $values
     * @throws \Exception
     */
    public function __construct(array $values)
    {
        if (empty($values)) {
            throw new InvalidVariationSetupException('Required Values must be provided');
        }

        foreach ($values as $k => $v) {
            $k = ucfirst($k);
            $methodName = "set{$k}";
            $this->{$methodName}($v);
        }

        $this->verifyRequired();
    }

    /**
     *lets loop through the attributes we have and test that they match the $required array;
     */
    public function verifyRequired()
    {
        //1. create the tmp array
        $tmpRequired = [];
        foreach ($this->required as $r) {
            $tmpRequired[$r] = 0;
        }

        $err = '';

        //2. verify if value is present
        foreach ($this->required as $r) {
            if (isset($this->{$r})) {
                $this->validateVariantAttribute($r, $this->{$r}, $err);

                unset($tmpRequired[$r]);
            }
        }

        //3. moan about it if we have to
        if ($err !== '') {
            throw new InvalidVariationSetupException($err);
        }

        if (!empty($tmpRequired)) {
            $err = implode(', ', array_keys($tmpRequired));
            throw new InvalidVariationSetupException("Missing Required Fields: {$err}");
        }
    }

    /**
     * @return string
     */
    public function getProductCode(): string
    {
        return $this->productCode;
    }

    /**
     * @param string $productCode
     * @return SimpleVariation
     * @throws \Exception
     */
    public function setProductCode(string $productCode): SimpleVariation
    {
        if(is_null($productCode) || $productCode == ''){
            throw new \Exception('Product code cannot be empty.');
        }

        $this->productCode = $productCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return SimpleVariation
     */
    public function setTitle(string $title): SimpleVariation
    {
        $this->title = $title;
        return $this;
    }


    /**
     * @param PriceInterface $price
     */
    public function setPrice(PriceInterface $price)
    {
        $this->price = $price;
    }

    /**
     * @param bool $includingVat
     * @param bool $convertToFloat
     * @param int $qty
     * @return mixed
     */
    public function getPrice(bool $includingVat, bool $convertToFloat = true, int $qty = 1)
    {
        return $this->price->getPrice($includingVat, $convertToFloat, $qty);
    }


}