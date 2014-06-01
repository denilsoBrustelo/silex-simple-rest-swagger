<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['notes.controller'] = $this->app->share(function () {
            return new Controllers\NotesController($this->app['notes.service']);
        });
    }

    public function bindRoutesToControllers()
    {
    	/**
    	 * @SWG\Resource(basePath="/api/v1",resourcePath="/notes")
    	 */
    	$api = $this->app["controllers_factory"];
        
        /**
         * @SWG\Api(
         *   path="/notes",
         *   description="Operations on notes", 
         *   @SWG\Operation(
         *      method="GET", 
		 *		summary="Find all notes",
         *      nickname="getAllNotes",
         *      type="array", items="$ref:note",
         *   	@SWG\ResponseMessage(code=404, message="Note not found"),
         *      @SWG\ResponseMessage(code=200, message="Note found")
         *   )
         * )
         */
        $api->get('/notes', "notes.controller:getAll");
        
        
        /**
         * @SWG\Api(
         *   path="/notes",
         *   @SWG\Operation(
         *      method="POST",
         *      summary="Create a new note",
         *      nickname="createANote",
         *      type="note",
         *      @SWG\Parameter(
		 *           name="id",
		 *           description="note's identifier",
		 *           paramType="path",
		 *           required=false,
		 *           type="string"
		 *      ),
         *      @SWG\Parameter(
		 *           name="note",
		 *           description="The note's content",
		 *           paramType="body",
		 *           required=true,
		 *           type="string"
		 *      ),   
         *   	@SWG\ResponseMessage(code=404, message="Note not found"),
         *      @SWG\ResponseMessage(code=200, message="Note found")
         *   )
         * )
         */
        $api->post('/notes', "notes.controller:save");
        
        /**
         * @SWG\Api(
         *   path="/notes/{id}",
         *   @SWG\Operation(
         *      method="POST",
         *      summary="Update an existint note",
         *      notes="Use this operation to update an existing note",
         *      nickname="updateANote",
         *      type="note",
         *      @SWG\Parameter(
		 *           name="id",
		 *           description="note's identifier",
		 *           paramType="path",
		 *           required=true,
		 *           type="string"
		 *      ),
         *      @SWG\Parameter(
		 *           name="note",
		 *           description="The note's content",
		 *           paramType="body",
		 *           required=true,
		 *           type="string"
		 *      ),   
         *   	@SWG\ResponseMessage(code=404, message="Note not found"),
         *   	@SWG\ResponseMessage(code=200, message="Note updated",responseModel="note")
         *   )
         * )
         */        
        $api->post('/notes/{id}', "notes.controller:update");
        
        /**
         * @SWG\Api(
         *   path="/notes/{id}",
         *   @SWG\Operation(
         *      method="DELETE",
         *      summary="Delete a note",
         *      notes="Use this method when you want to delete a note",
         *      nickname="deleteANote",
         *      @SWG\Parameter(
         *           name="id",
         *           description="note's identifier",
         *           paramType="path",
         *           required=true,
         *           type="string"
         *      ),
         *   	@SWG\ResponseMessage(code=404, message="Note not found"),
         *   	@SWG\ResponseMessage(code=200, message="Note deleted", responseModel="integer")
         *   )
         * )
         */
        $api->delete('/notes/{id}', "notes.controller:delete");

        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}


