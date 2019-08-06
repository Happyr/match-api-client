<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Tests\Model\Role;

use HappyrMatch\ApiClient\Model\Role\Role;
use HappyrMatch\ApiClient\Tests\Model\BaseModelTest;

class RoleTest extends BaseModelTest
{
    public function testCreate()
    {
        $json =
            <<<'JSON'
{
    "data": {
        "type": "role",
        "id": "75431435-fc87-46a0-9574-ddc6d48b126d",
        "attributes": {
            "description": "Alice think it would like the look of the way--' 'THAT generally takes some time,' interrupted the.",
            "advert": {
                "title": "Mixing and Blending Machine Operator",
                "body_text": "Alice, and she dropped it hastily, just in time to wash the things I used to do:-- 'How doth the little door: but, alas! the little door was shut again, and we won't talk about her other little children, and make one repeat lessons!' thought Alice; 'only, as it's asleep, I suppose Dinah'll be sending me on messages next!' And she tried the roots of trees, and I've tried banks, and I've tried banks, and I've tried hedges,' the Pigeon in a louder tone. 'ARE you to offer it,' said Alice. 'Why.",
                "body_html": "<html><head><title>Autem inventore aut officia aut aut blanditiis et ducimus eos.<\/title><\/head><body><form action=\"example.org\" method=\"POST\"><label for=\"username\">odit<\/label><input type=\"text\" id=\"username\"><label for=\"password\">amet<\/label><input type=\"password\" id=\"password\"><\/form>Quidem ut sunt et quidem est.Fuga est placeat rerum ut et enim ex.<\/body><\/html>\n",
                "link": "http:\/\/romaguera.com\/delectus-aut-nam-et-eum.html"
            },
            "location": {
                "country": "BD",
                "region": "Just outside Lake Arnulfoview",
                "city": "West Guiseppe",
                "address": "310 Prosacco Well Apt. 388\nNew Jeanettetown, VA 64797"
            }
        },
        "relationships": {
            "category": {
                "data": {
                    "type": "role-category",
                    "id": "e286921e-acf4-4a29-988f-59faedc98f2b"
                }
            }
        }
    },
    "included": [
        {
            "type": "role-category",
            "id": "e286921e-acf4-4a29-988f-59faedc98f2b",
            "attributes": {
                "code": "role_0",
                "name": "Role 0"
            }
        }
    ]
}

JSON;
        $model = Role::createFromArray(json_decode($json, true));
        $this->assertEquals('75431435-fc87-46a0-9574-ddc6d48b126d', $model->getId());
    }
}
