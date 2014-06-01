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
    	 * @SWG\Resource(basePath="http://localhost:9001/api/v1", resourcePath="/notes")
    	 */
    	$api = $this->app["controllers_factory"];
        
        /**
         * @SWG\Api(
         *   path="/notes",
         *   description="Operation sur les notes", 
         *   @SWG\Operation(
         *      method="GET", 
		 *		summary="Rechercher toutes les notes",
         *      nickname="getAllNotes",
         *      type="array", items="$ref:note",
         *   	@SWG\ResponseMessage(code=404, message="Note non trouvée"),
         *      @SWG\ResponseMessage(code=200, message="Note trouvée")
         *   )
         * )
         */
        $api->get('/notes', "notes.controller:getAll");
        
        
        /**
         * @SWG\Api(
         *   path="/notes",
         *   @SWG\Operation(
         *      method="POST",
         *      summary="Creation d'une note",
         *      nickname="createANote",
         *   	@SWG\ResponseMessage(code=404, message="Note non trouvée"),
         *      @SWG\ResponseMessage(code=200, message="Note trouvée")
         *   )
         * )
         */
        $api->post('/notes', "notes.controller:save");
        
        /**
         * @SWG\Api(
         *   path="/notes/{id}",
         *   @SWG\Operation(
         *      method="POST",
         *      summary="Mise à jour d'une note",
         *      notes="C'est pour mettre à jour les notes",
         *      nickname="updateANote",
         *      type="note",
         *      @SWG\Parameter(
		 *           name="id",
		 *           description="Identifiant de la note",
		 *           paramType="path",
		 *           required=true,
		 *           type="string"
		 *      ),
         *      @SWG\Parameter(
		 *           name="note",
		 *           description="La note",
		 *           paramType="body",
		 *           required=true,
		 *           type="note"
		 *      ),   
         *   	@SWG\ResponseMessage(code=404, message="Note non trouvée"),
         *   	@SWG\ResponseMessage(code=200, message="Note mise a jour",responseModel="note")
         *   )
         * )
         */        
        $api->post('/notes/{id}', "notes.controller:update");
        
        /**
         * @SWG\Api(
         *   path="/notes/{id}",
         *   @SWG\Operation(
         *      method="DELETE",
         *      summary="Suppression d'une note",
         *      notes="C'est pour supprimer une note",
         *      nickname="deleteANote",
         *      @SWG\Parameter(
         *           name="id",
         *           description="Identifiant de la note",
         *           paramType="path",
         *           required=true,
         *           type="string"
         *      ),
         *   	@SWG\ResponseMessage(code=404, message="Note non trouvée"),
         *   	@SWG\ResponseMessage(code=200, message="Note supprimée", responseModel="integer")
         *   )
         * )
         */
        $api->delete('/notes/{id}', "notes.controller:delete");

        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}


