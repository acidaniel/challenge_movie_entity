<?php

namespace Drupal\challenge_movie_entity\Normalizer;

use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Entity\EntityTypeRepositoryInterface;
use Drupal\serialization\Normalizer\EntityNormalizer;

class MovieNormalizer extends EntityNormalizer {

  /**
   * Constructs an EntityNormalizer object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityTypeRepositoryInterface $entity_type_repository
   *   The entity type repository.
   * @param \Drupal\Core\Entity\EntityFieldManagerInterface $entity_field_manager
   *   The entity field manager.
   */
 public function __construct(EntityTypeManagerInterface $entity_type_manager, EntityTypeRepositoryInterface $entity_type_repository, EntityFieldManagerInterface $entity_field_manager) {
    parent::__construct($entity_type_manager, $entity_type_repository, $entity_field_manager);
 }

  /**
   * {@inheritdoc}
   */
  public function normalize($entity, $format = NULL, array $context = []) {
    // Since we want to override the default normalize we don't need the parent.
    //$data = parent::normalize($entity, $format, $context);
    $data['id'] = $entity->id();
    $data['title'] = $entity->getTitle();
    $data['release_date'] = $entity->release_date->getValue()[0]['value'];
    $data['genre'] = !$entity->genre->isEmpty() ? $entity->genre->entity->getName() : NULL ;
    return $data;
  }  
}
