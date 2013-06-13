<?php
/**
 * @var $this View
 */
$options = array(
    'type' => 'file',
    'inputDefaults' => array(
        'label' => false,
        'div' => false, //don't work? why?
        'class' => 'span12',
    )
);
?>

<div id="secondary" class="pull-left">
    <h2>Event Email Config</h2>
</div>

<div id="primary">

    <? echo $this->Form->create('EventEmailConfig', $options); ?>
    <div class="row-fluid">
        <div class="span7">
            <h3>Config Details</h3>

            <div class="row-fluid row-event-config-email_from">
                <label for="email_from">Email</span></label>
                <?= $this->Form->input('email_from', array('div' => false, 'placeholder' => 'Email Address',)); ?>
            </div>
            <div class="row-fluid row-event-config-desc">
                <label for="subject">Subject</span></label>
                <?= $this->Form->input('subject', array('div' => false, 'placeholder' => 'Subject',)); ?>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <label for="image_background">Image Background <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <?php
                                $src = (!empty($this->request->data['EventEmailConfig']['image_background']))
                                    ? $this->request->data['EventEmailConfig']['image_background']
                                    : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
                                echo $this->Html->image($src); ?>

                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_background'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_header">Image Header <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <?php
                                $src = (!empty($this->request->data['EventEmailConfig']['image_header']))
                                    ? $this->request->data['EventEmailConfig']['image_header']
                                    : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
                                echo $this->Html->image($src); ?>
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_header'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_footer">Image Footer <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"/></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_header'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_left">Image Left <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"/></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_left'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">
                    <label for="image_right">Image Right <span>(100kb max.)</span></label>

                    <div class="row-fluid">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image"/></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                    <?= $this->Form->file('image_right'); ?>
                                </span>
                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <label for="social_share">Social Share </label>
                <?=$this->Form->textarea('social_share', array(
                'div' => false,
                'placeholder' => 'Social Share')); ?>
            </div>



            <div class="row-fluid">
                <?=$this->Form->end(array('id' => 'submitBtn', 'class' => 'btn btn-large btn-block btn-primary', 'label' => 'Save',))?>
            </div>


        </div>
    </div>


</div>