<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerLPZQZt5\srcDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerLPZQZt5/srcDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerLPZQZt5.legacy');

    return;
}

if (!\class_exists(srcDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerLPZQZt5\srcDevDebugProjectContainer::class, srcDevDebugProjectContainer::class, false);
}

return new \ContainerLPZQZt5\srcDevDebugProjectContainer(array(
    'container.build_hash' => 'LPZQZt5',
    'container.build_id' => '39f650c2',
    'container.build_time' => 1537210197,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerLPZQZt5');
