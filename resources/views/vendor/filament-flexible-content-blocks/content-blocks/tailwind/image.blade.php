<div class="{{ $getBackgroundColourClass() }} mb-3">
    <div @class([
        'w-full',
        $getImageWidthClass(),
        'w-90 mx-auto' => $imagePosition === 'center', // Центрування зображення
        'ml-auto' => $imagePosition === 'right', // Вирівнювання зліва
        'mr-auto' => $imagePosition === 'left', // Вирівнювання справа
    ])>
        <img src="{{ $getImageMedia(attributes: ['class' => 'img-fluid', 'loading' => 'lazy']) }}
        </div>
</div>
