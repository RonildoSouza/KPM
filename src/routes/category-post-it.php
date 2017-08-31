<?php

/**
 * @apiDefine Success
 * @apiSuccess {Number} id Unique
 * @apiSuccess {String} acronym Unique
 * @apiSuccess {String} name
 * @apiSuccess {Object[]} postIts
 */

/**
 *
 * @api {get} /kpm/v1/categories[?withPostIts=true] Get all categories
 * @apiName getAll
 * @apiGroup CategoryPostIt
 * @apiVersion  1.0.0
 *
 *
 * @apiParam  {Boolean} withPostIts Query string params
 *
 * @apiUse Success
 *
 * @apiParamExample
 *    [
 *       {
 *          "id":1,
 *          "acronym":"CAT1",
 *          "name":"Category 1",
 *          "postIts":[
 *
 *          ]
 *       },
 *       {
 *          "id":2,
 *         "acronym":"CAT2",
 *          "name":"Category 2",
 *          "postIts":[
 *             {
 *                "id":3,
 *                "title":"Title Post-it 3",
 *                "summary":"Cillum consectetur pariatur aute excepteur anim nisi dolor officia elit sint consectetur cillum.",
 *                "estimatedTime":60
 *             },
 *             {
 *                "id":4,
 *                "title":"Title Post-it 4",
 *                "summary":"Irure est duis irure occaecat quis elit.",
 *                "estimatedTime":300
 *             }
 *          ]
 *       },
 *       {
 *          "id":3,
 *          "acronym":"CAT3",
 *          "name":"Category 3",
 *          "postIts":[
 *             {
 *                "id":1,
 *                "title":"Title Post-it 1",
 *                "summary":"Nostrud mollit labore voluptate ea cillum sint exercitation sint commodo exercitation.",
 *                "estimatedTime":120
 *             }
 *          ]
 *       },
 *       {
 *          "id":4,
 *          "acronym":"CAT4",
 *          "name":"Category 4",
 *          "postIts":[
 *             {
 *                "id":2,
 *                "title":"Title Post-it 2",
 *                "summary":"Duis laboris nulla laborum laborum voluptate incididunt dolor esse commodo excepteur cupidatat irure.",
 *                "estimatedTime":240
 *             }
 *          ]
 *       },
 *       {
 *          "id":5,
 *          "acronym":"CAT5",
 *          "name":"Category 5",
 *          "postIts":[
 *
 *          ]
 *       }
 *    ]
 *
 *
 * @apiSuccessExample
 *    HTTP/1.1 200 OK
 *    [
 *         {
 *            "id":1,
 *            "acronym":"CAT1",
 *            "name":"Category 1"
 *         },
 *         {
 *            "id":2,
 *            "acronym":"CAT2",
 *            "name":"Category 2"
 *         },
 *         {
 *            "id":3,
 *            "acronym":"CAT3",
 *            "name":"Category 3"
 *         },
 *         {
 *            "id":4,
 *            "acronym":"CAT4",
 *            "name":"Category 4"
 *         },
 *         {
 *            "id":5,
 *            "acronym":"CAT5",
 *            "name":"Category 5"
 *         }
 *    ]
 *
 *
 */
$app->get('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:getAll');

/**
 *
 * @api {get} /kpm/v1/categories/:id[?withPostIts=true] Get category by id
 * @apiName getById
 * @apiGroup CategoryPostIt
 * @apiVersion  1.0.0
 *
 *
 * @apiParam  {Boolean} withPostIts Query string params
 *
 * @apiUse Success
 *
 * @apiParamExample
 *    {
 *       "id":2,
 *      "acronym":"CAT2",
 *       "name":"Category 2",
 *       "postIts":[
 *          {
 *             "id":3,
 *             "title":"Title Post-it 3",
 *             "summary":"Cillum consectetur pariatur aute excepteur anim nisi dolor officia elit sint consectetur cillum.",
 *             "estimatedTime":60
 *          },
 *          {
 *             "id":4,
 *             "title":"Title Post-it 4",
 *             "summary":"Irure est duis irure occaecat quis elit.",
 *             "estimatedTime":300
 *          }
 *       ]
 *    }
 *
 *
 * @apiSuccessExample
 *    HTTP/1.1 200 OK
 *    {
 *       "id":2,
 *       "acronym":"CAT2",
 *       "name":"Category 2"
 *    }
 *
 */
$app->get('/kpm/v1/categories/{id}', 'KPM\Controllers\CategoryPostItController:getById');

/**
 *
 * @api {post} /kpm/v1/categories Create category
 * @apiName insertOrUpdate
 * @apiGroup CategoryPostIt
 * @apiVersion  1.0.0
 *
 *
 * @apiParamExample
 *    {
 *       "acronym":"NCAT",
 *       "name":"New Category"
 *    }
 *
 *
 * @apiSuccessExample
 *    HTTP/1.1 201 OK
 *    {
 *       "id":999,
 *       "acronym":"NCAT",
 *       "name":"New Category"
 *    }
 *
 */
$app->post('/kpm/v1/categories', 'KPM\Controllers\CategoryPostItController:insertOrUpdate');

/**
 *
 * @api {put} /kpm/v1/categories/:id Motify category
 * @apiName insertOrUpdate
 * @apiGroup CategoryPostIt
 * @apiVersion  1.0.0
 *
 *
 * @apiParamExample
 *    {
 *       "acronym":"MCAT",
 *       "name":"Modify Category"
 *    }
 *
 *
 * @apiSuccessExample
 *    HTTP/1.1 201 OK
 *    {
 *       "id":999,
 *       "acronym":"MCAT",
 *       "name":"Modify Category"
 *    }
 *
 */
$app->put('/kpm/v1/categories/{id}', 'KPM\Controllers\CategoryPostItController:insertOrUpdate');

/**
 *
 * @api {delete} /kpm/v1/categories/:id Delete category
 * @apiName delete
 * @apiGroup CategoryPostIt
 * @apiVersion  1.0.0
 *
 *
 * @apiSuccess (200)
 *
 */
$app->delete('/kpm/v1/categories/{id}', 'KPM\Controllers\CategoryPostItController:delete');
