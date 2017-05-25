<?php
/* @var $this \Cake\View\View */
$this->extend('/Layout/dashboard');
?>

<?php $this->start('content_header'); ?>

<?php $this->end(); ?>

<?php $this->start('content_buttons'); ?>
<?php $this->end(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-offset-5">
            <h1 class="assignmentTitle">Opgave 1</h1>
        </div>
    </div>
    <hr class="black-line" noshade="">

    <div class="row">
        <div class="col-lg-12">
            <h4 class="assignmentDescription">Her skal du læse teksten og <br> markere de ord du ikke forstår</h4>
            <h4 class="assignmentDescription"><b>Marker mindst 5</b></h4>
        </div>

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi viverra, lectus non malesuada tincidunt, sem neque luctus odio, eget molestie justo leo quis nunc. In hac habitasse platea dictumst. Ut fermentum consequat scelerisque. Nam at luctus massa, commodo blandit purus. Aenean neque lectus, commodo non felis quis, ullamcorper feugiat orci. Donec ac sapien lobortis, suscipit eros vel, efficitur nulla. Aliquam ac diam sed purus ornare accumsan at id turpis.

                    Suspendisse maximus sagittis mattis. Vivamus ut augue quis tellus egestas laoreet eget sed tortor. Mauris consequat quam a nunc lacinia, eget tristique sem blandit. Mauris fringilla ornare ante, eu consectetur nisi blandit nec. Pellentesque dapibus iaculis convallis. Aliquam sed tortor rutrum, auctor elit eget, dictum ex. Donec viverra dapibus nulla, ut pulvinar odio. Phasellus scelerisque nisl ut fringilla bibendum. Aenean commodo, ex at maximus pellentesque, neque enim maximus felis, vitae molestie dui justo molestie ex. In hac habitasse platea dictumst. Morbi mattis ornare venenatis. Suspendisse ante elit, imperdiet in nisl non, venenatis ullamcorper lacus. Nullam a lectus diam. Nullam ut vestibulum nisl, nec eleifend lorem. Sed lobortis feugiat lectus at accumsan. Fusce condimentum, turpis quis commodo efficitur, dui nulla blandit velit, nec laoreet enim erat vitae sem. Duis ultricies sem nisl.</div>
            </div>

            <button type="button" class="done-btn btn btn-warning">Done</button>
            <h4 class="assignmentDescription">Her skal du læse teksten <br> og markere de ord du ikke forstår <br> og gerne vil arbejde med</h4>
        </div>
    </div>
</div>
