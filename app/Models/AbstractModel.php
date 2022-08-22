<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

/**
 * * Class CustomModel
 * @package App\Extended
 *
 * @method static $this find(int $id)
 * @method static $this create(array $attributes = [])
 * @method LengthAwarePaginator paginate(array $attributes = [])
 * @method Builder withTrashed()
 * @method bool restore()
 *
 * @property int    id
 * @property string created_at
 * @property string updated_at
 * @property string deleted_at
 */
abstract class AbstractModel extends Model
{
    public static $snakeAttributes = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['lastIdentifier', 'deleted_at'];

    /**
     * @param string $class
     */
    public static function cacheMutatedAttributes($class)
    {
        $mutatedAttributes = [];

        // Here we will extract all of the mutated attributes so that we can quickly
        // spin through them after we export models to their array form, which we
        // need to be fast. This'll let us know the attributes that can mutate.
        foreach (get_class_methods($class) as $method) {
            if (strpos($method, 'Attribute') !== false &&
                preg_match('/^get(.+)Attribute$/', $method, $matches)
            ) {
                if (static::$snakeAttributes || (in_array($matches[1], ['CreatedAt', 'UpdatedAt', 'DeletedAt']))) {

                    $matches[1] = Str::snake($matches[1]);
                }

                $mutatedAttributes[] = lcfirst($matches[1]);
            }
        }

        static::$mutatorCache[$class] = $mutatedAttributes;
    }

    /**
     * @param string $eventName
     *
     * @return mixed
     */
    public function fireEvent(string $eventName)
    {
        return $this->fireModelEvent($eventName);
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function getCreatedAtFormatted(string $format = 'Y-m-d H:i')
    {
        return $this->formatDate($this->created_at, $format);
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function getUpdatedAtFormatted(string $format = 'Y-m-d H:i')
    {
        return $this->formatDate($this->updated_at, $format);
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function getDeletedAtFormatted(string $format = 'd/m/Y H:i')
    {
        return $this->formatDate($this->deleted_at, $format);
    }

    /**
     * @param string $date
     * @param string $outputFormat
     * @param string $inputFormat
     *
     * @return string
     */
    public function formatDate($date, string $outputFormat = 'd/m/Y H:i', string $inputFormat = 'Y-m-d H:i:s')
    {
        if (!is_null($date)) {
            try {
                $date = Carbon::createFromFormat($inputFormat, $date)->format($outputFormat);
            } catch (\Exception $e) {
                return $date;
            }
        }

        return $date;
    }

    /**
     * @return AbstractModel
     */
    public function clearRelations(): self
    {
        $this->relations = [];

        return $this;
    }

}
