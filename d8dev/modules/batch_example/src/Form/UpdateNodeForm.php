<?php
namespace Drupal\batch_example\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Class UpdateNodeForm.
 *
 * @package Drupal\batch_example\Form
 */
class UpdateNodeForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'update_node_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['update_node'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Update Node'),
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'ct1')
      ->sort('created', 'ASC')
      ->execute();
    $batch = array(
      'title' => t('Updating Node...'),
      'operations' => array(
        array(
          '\Drupal\batch_example\UpdateNode::updateNodeExample',
          array($nids)
        ),
      ),
      'finished' => '\Drupal\batch_example\UpdateNode::updateNodeExampleFinishedCallback',
    );
    batch_set($batch);
  }
}
