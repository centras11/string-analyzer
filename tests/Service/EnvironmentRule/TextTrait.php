<?php

namespace Analyzer\Tests\Service\EnvironmentRule;

/**
 * Trait TextTrait
 * @package Analyzer\Tests\Service\EnvironmentRule
 */
trait TextTrait
{
    /**
     * @return string
     */
    public function getText(): string
    {
        return '
Ąžuolas – bukinių šeimos medžių gentis. Gentyje yra apie 600 šių augalų rūšių.
Morbi eget posuere urna. Sed tincidunt laoreet magna, duis sollicitudin,
ligula id vehicula dignissim, massa dolor imperdiet mauris, sed tempus felis
ex ut orci. Etiam pharetra, felis. Ac aliquet pulvinar, mi ante ultricies
lorem, vitae vehicula nisl dui non mauris. Cras porttitor, augue in viverra
laoreet, neque leo congue mi, eu egestas metus sapien nec orci. Nunc egestas
malesuada justo sed hendrerit, quisque vitae pellentesque enim. Cras ex est,
ornare malesuada risus vitae, vestibulum scelerisque metus. Vivamus lacus
metus, scelerisque in nulla id, dignissim venenatis nunc. Etiam finibus
ullamcorper ex, et gravida erat vulputate et. Nunc non varius risus, non
ultrices quam. Sed nec dictum est.         
        ';
    }
}
