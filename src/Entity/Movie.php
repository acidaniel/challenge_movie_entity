<?php

namespace Drupal\challenge_movie_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\challenge_movie_entity\MovieInterface;

/**
 * Defines the movie entity class.
 *
 * @ContentEntityType(
 *   id = "movie",
 *   label = @Translation("Movie"),
 *   label_collection = @Translation("Movies"),
 *   handlers = {
 *     "view_builder" = "Drupal\challenge_movie_entity\MovieViewBuilder",
 *     "list_builder" = "Drupal\challenge_movie_entity\MovieListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\challenge_movie_entity\MovieAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\challenge_movie_entity\Form\MovieForm",
 *       "edit" = "Drupal\challenge_movie_entity\Form\MovieForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "movie",
 *   admin_permission = "administer movie",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/movie/add",
 *     "canonical" = "/movie/{movie}",
 *     "edit-form" = "/admin/content/movie/{movie}/edit",
 *     "delete-form" = "/admin/content/movie/{movie}/delete",
 *     "collection" = "/admin/content/movie"
 *   },
 *   field_ui_base_route = "entity.movie.settings"
 * )
 */
class Movie extends ContentEntityBase implements MovieInterface {

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title) {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return (bool) $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus($status) {
    $this->set('status', $status);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    // Standard Base field for the title.
    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The title of the movie entity.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => 1,
      ])
      ->setDisplayConfigurable('form', TRUE)

      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);

    // Standard Base Field to indicate if content entity is enabled.
    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Status'))
      ->setDescription(t('A boolean indicating whether the movie is enabled.'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Published')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);

    // Custom Reference Field to Genre Taxonomy Vocabulary.
    $fields['genre'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Genre'))
      ->setDescription(t('Define the Genre of the movie.'))
      ->setSetting('target_type', 'taxonomy_term')
      ->setSetting('handler', 'default:taxonomy_term')
      ->setSetting('handler_settings', [
        'target_bundles' => [
          'genre' => 'genre'
        ]
      ])

      ->setDisplayOptions('view', [
        'label' => 'above',
        'weight' => 2,
      ])

      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 3, 
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '40',
        ]
      ])

      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);
    
    // Custom field to store release date for the Movie.
    $fields['release_date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Release Date'))
      ->setDescription(t('Date of when the movie was released'))
      ->setRequired(TRUE)
      ->setSettings([
        'datetime_type' => 'date'
      ])

      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => [
          'format_type' => 'medium'
        ],
        'weight' => -3,
      ])

      ->setDisplayOptions('form', [
        'type' => 'datetime',
        'size' => '30',
        'weight' => 2,
      ])

      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE); 
    
    return $fields;
  }

}
