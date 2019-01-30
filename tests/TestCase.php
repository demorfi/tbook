<?php

namespace Tests;

use Illuminate\Foundation\Testing\{DatabaseMigrations, TestCase as BaseTestCase, WithFaker};

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, WithFaker;
}
