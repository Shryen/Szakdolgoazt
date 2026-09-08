<?php

namespace App;

enum RoleEnum: string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case ADMIN = 'admin';
}