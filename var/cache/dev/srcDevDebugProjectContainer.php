<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKbnY02G\srcDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKbnY02G/srcDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerKbnY02G.legacy');

    return;
}

if (!\class_exists(srcDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerKbnY02G\srcDevDebugProjectContainer::class, srcDevDebugProjectContainer::class, false);
}

return new \ContainerKbnY02G\srcDevDebugProjectContainer(array(
    'container.build_hash' => 'KbnY02G',
    'container.build_id' => 'afe059a9',
    'container.build_time' => 1536778439,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerKbnY02G');
