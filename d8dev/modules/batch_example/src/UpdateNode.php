<?php
namespace Drupal\batch_example;
use Drupal\node\Entity\Node;
class UpdateNode {
  public static function updateNodeExample($nids, &$context){
    $message = 'Updating Node...';
    $results = array();
    foreach ($nids as $nid) {
      $node = Node::load($nid);
    // $results = $node->getFieldDefinitions();
    $node->field_node_id->value = $nid;
    $results [] = $node->save();
    }
    $context['message'] = $message;
    $context['results'] = $results;
    //  $context['message'] = $results;
  }
  function updateNodeExampleFinishedCallback($success, $results, $operations) {
    // The 'success' parameter means no fatal PHP errors were detected. All
    // other error management should be handled using 'results'.
    if ($success) {
      $message = \Drupal::translation()->formatPlural(
        count($results),
        'One post processed.', '@count posts processed.'
      );
    }
    else {
      $message = t('Finished with an error.');
    }
    drupal_set_message($message);
  }
}
