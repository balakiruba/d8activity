<?php

/*
 * @file
 * Contains \Drupal\mymodule\Form\ConfigForm.
 *
 */

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'd8day3_config_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mymodule.form');
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Name'),
      '#required' => TRUE,
      '#default_value' => $config->get('name'),
    );
    $form['gender'] = array(
      '#type' => 'radios',
      '#title' => t('Gender'),
      '#maxlength' => 1,
      '#options' => array(t('Male'),t('Female')),
      '#default_value' => $config->get('gender'),
    );
    $form['degree'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Choose ur Favourite colors'),
      '#options' => array(t('Red'),t('Black'),t('Blue'),t('Pink'),t('White'),t('Orange'),t('Yellow')),
      '#default_value' => $config->get('degree'),
    );
    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
      '#default_value' => $config->get('description'),
    );
    return parent::buildForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config(('mymodule.form'))
      ->set('name', $form_state->getValue('name'))
      ->set('gender', $form_state->getValue('gender'))
      ->set('degree', $form_state->getValue('degree'))
      ->set('description', $form_state->getValue('description'))
      ->save();
  }
  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return ['mymodule.form'];
  }
}
