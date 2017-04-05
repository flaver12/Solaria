<?php

namespace FM\App\models;

/**
 * @Entity @Table(name="category")
 **/
class Category {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="string") **/
    protected $created;
