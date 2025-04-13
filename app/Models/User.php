<?php

namespace App\Models;

class User
{
    private static $users = [];
    private static $nextId = 1;

    public static function all()
    {
        return self::$users;
    }

    public static function find($id)
    {
        foreach (self::$users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        return null;
    }

    public static function create($data)
    {
        $data['id'] = self::$nextId++;
        self::$users[] = $data;
        return $data;
    }

    public static function update($id, $data)
    {
        foreach (self::$users as &$user) {
            if ($user['id'] == $id) {
                $user = array_merge($user, $data);
                return $user;
            }
        }
        return null;
    }

    public static function delete($id)
    {
        self::$users = array_filter(self::$users, function($user) use ($id) {
            return $user['id'] != $id;
        });
        return true;
    }

    public static function exists($field, $value, $exceptId = null)
    {
        foreach (self::$users as $user) {
            if ($user[$field] == $value && $user['id'] != $exceptId) {
                return true;
            }
        }
        return false;
    }
}