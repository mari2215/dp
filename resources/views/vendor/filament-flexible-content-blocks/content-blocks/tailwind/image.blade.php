<style>
    .w-90 {
        width: 90%;
    }

    .image-vertical {
        float: left;
    }

    .image-vertical-right {
        float: right;
    }
</style>

<div class="{{ $getBackgroundColourClass() }} mb-3">
    <div class="container">
        <div @class([
            'w-full',
            $getImageWidthClass(),
            'w-90 mx-auto' => $imagePosition === 'center', // Центрування зображення
            'ml-auto' => $imagePosition === 'right', // Вирівнювання зліва
            'mr-auto' => $imagePosition === 'left', // Вирівнювання справа
        ])>
            <img src="{{ $getImageMedia(attributes: ['class' => 'img-fluid', 'loading' => 'lazy']) }}" </div>
        </div>
    </div>
