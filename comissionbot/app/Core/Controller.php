<?PHP

namespace App\Core;

use Psr\Container\ContainerInterface;

abstract class Controller
{
    protected  $c;
    public function __construct(ContainerInterface $c)
    {
        $this->c = $c;
    }
}
