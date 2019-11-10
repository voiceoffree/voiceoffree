<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

$doc = JFactory::getDocument();
$app = JFactory::getApplication();

$tmp_params = JFactory::getApplication()->getTemplate('true')->params;
?>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 text-center">

        <div class="reg-login-form-wrap">
            <div class="reg-login-title">
                <h3><?php echo JText::_('COM_USERS_REGISTRATION_TITLE'); ?></h3>
            </div>


            <div class="registration<?php echo $this->pageclass_sfx ?>">
                <?php if ($this->params->get('show_page_heading')) : ?>
                    <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
                <?php endif; ?>

                <form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate" enctype="multipart/form-data">

                    <?php foreach ($this->form->getFieldsets() as $fieldset):// Iterate through the form fieldsets and display each one.?>
                        <?php
                        /* Set placeholder for username, password and secretekey */
                        $this->form->setFieldAttribute('name', 'hint', JText::_('COM_USERS_REGISTER_NAME_LABEL'));
                        $this->form->setFieldAttribute('username', 'hint', JText::_('COM_USERS_LOGIN_USERNAME_LABEL'));
                        $this->form->setFieldAttribute('password1', 'hint', JText::_('JGLOBAL_PASSWORD'));
                        $this->form->setFieldAttribute('password2', 'hint', JText::_('COM_USERS_PROFILE_PASSWORD2_LABEL'));
                        $this->form->setFieldAttribute('email1', 'hint', JText::_('JGLOBAL_EMAIL'));
                        $this->form->setFieldAttribute('email2', 'hint', JText::_('COM_USERS_REGISTER_EMAIL2_LABEL'));
                        ?>

                        <?php $fields = $this->form->getFieldset($fieldset->name); ?>
                        <?php if (count($fields)): ?>
                            <?php foreach ($fields as $field) :// Iterate through the fields in the set and display them. ?>
                                <?php if ($field->hidden):// If the field is hidden, just display the input. ?>
                                    <?php echo $field->input; ?>
                                <?php else: ?>
                                    <div class="form-group">
                                        <?php if ($field->type != 'Spacer') { ?>
                                            <?php echo $field->label; ?>
                                        <?php } ?>
                                        <?php if (!$field->required && $field->type != 'Spacer') : ?>
                                            <span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
                                        <?php endif; ?>

                                        <div class="group-control">
                                            <?php echo $field->input; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary validate">
                            <?php echo JText::_('JREGISTER'); ?>
                            <i class="fa fa-angle-right"></i>
                        </button>
                        <!--<a class="btn btn-danger" href="<?php //echo JRoute::_('');     ?>" title="<?php //echo JText::_('JCANCEL');     ?>"><?php //echo JText::_('JCANCEL');     ?></a> -->
                        <input type="hidden" name="option" value="com_users" />
                        <input type="hidden" name="task" value="registration.register" />
                    </div>
                    <?php echo JHtml::_('form.token'); ?>
                </form>
                <p>
                    <?php echo JTEXT::_('HELIX_ALREADY_ACCOUNT'); ?> <a href="<?php echo JRoute::_('index.php?option=com_users&view=login'); ?>"><?php echo JText::_('HELIX_LOGIN'); ?></a>
                </p>
            </div>
        </div>
    </div>
</div>
