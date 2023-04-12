<?php

namespace Drupal\challenge_movie_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the movie entity edit forms.
 */
class MovieForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New movie %label has been created.', $message_arguments));
      $this->logger('challenge_movie_entity')->notice('Created new movie %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The movie %label has been updated.', $message_arguments));
      $this->logger('challenge_movie_entity')->notice('Updated new movie %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.movie.canonical', ['movie' => $entity->id()]);
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#attached']['library'][] = 'challenge_movie_entity/form_edit';
    
    $form_build = parent::buildForm($form, $form_state);
    return $form_build;
    //return parent::buildForm($form, $form_state);
  }

}
