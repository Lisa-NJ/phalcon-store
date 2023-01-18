<?php
declare(strict_types=1);

 

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model;


class UserController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        //
    }

    /**
     * Searches for user
     */
    public function searchAction()
    {
        $numberPage = $this->request->getQuery('page', 'int', 1);
        $parameters = Criteria::fromInput($this->di, 'User', $_GET)->getParams();
        $parameters['order'] = "id";

        $paginator   = new Model(
            [
                'model'      => 'User',
                'parameters' => $parameters,
                'limit'      => 10,
                'page'       => $numberPage,
            ]
        );

        $paginate = $paginator->paginate();

        if (0 === $paginate->getTotalItems()) {
            $this->flash->notice("The search did not find any user");

            $this->dispatcher->forward([
                "controller" => "user",
                "action" => "index"
            ]);

            return;
        }

        $this->view->page = $paginate;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        //
    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $user = User::findFirstByid($id);
            if (!$user) {
                $this->flash->error("user was not found");

                $this->dispatcher->forward([
                    'controller' => "user",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("username", $user->username);
            $this->tag->setDefault("slug", $user->slug);
            $this->tag->setDefault("password_hash", $user->password_hash);
            $this->tag->setDefault("reauthentication_token", $user->reauthentication_token);
            $this->tag->setDefault("email", $user->email);
            $this->tag->setDefault("email_verified", $user->email_verified);
            $this->tag->setDefault("email_token", $user->email_token);
            $this->tag->setDefault("email_token_expires", $user->email_token_expires);
            $this->tag->setDefault("login_attempts", $user->login_attempts);
            $this->tag->setDefault("lockout", $user->lockout);
            $this->tag->setDefault("last_login", $user->last_login);
            $this->tag->setDefault("last_action", $user->last_action);
            $this->tag->setDefault("is_admin", $user->is_admin);
            $this->tag->setDefault("created", $user->created);
            $this->tag->setDefault("modified", $user->modified);
            $this->tag->setDefault("language", $user->language);
            $this->tag->setDefault("application_id", $user->application_id);
            $this->tag->setDefault("stripe_id", $user->stripe_id);
            
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        $user = new User();
        $user->username = $this->request->getPost("username");
        $user->slug = $this->request->getPost("slug");
        $user->passwordHash = $this->request->getPost("password_hash");
        $user->reauthenticationToken = $this->request->getPost("reauthentication_token");
        $user->email = $this->request->getPost("email", "email");
        $user->emailVerified = $this->request->getPost("email_verified");
        $user->emailToken = $this->request->getPost("email_token");
        $user->emailTokenExpires = $this->request->getPost("email_token_expires");
        $user->loginAttempts = $this->request->getPost("login_attempts", "int");
        $user->lockout = $this->request->getPost("lockout");
        $user->lastLogin = $this->request->getPost("last_login");
        $user->lastAction = $this->request->getPost("last_action");
        $user->isAdmin = $this->request->getPost("is_admin");
        $user->created = $this->request->getPost("created");
        $user->modified = $this->request->getPost("modified");
        $user->language = $this->request->getPost("language");
        $user->applicationId = $this->request->getPost("application_id", "int");
        $user->stripeId = $this->request->getPost("stripe_id");
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("user was created successfully");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $user = User::findFirstByid($id);

        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        $user->username = $this->request->getPost("username");
        $user->slug = $this->request->getPost("slug");
        $user->passwordHash = $this->request->getPost("password_hash");
        $user->reauthenticationToken = $this->request->getPost("reauthentication_token");
        $user->email = $this->request->getPost("email", "email");
        $user->emailVerified = $this->request->getPost("email_verified");
        $user->emailToken = $this->request->getPost("email_token");
        $user->emailTokenExpires = $this->request->getPost("email_token_expires");
        $user->loginAttempts = $this->request->getPost("login_attempts", "int");
        $user->lockout = $this->request->getPost("lockout");
        $user->lastLogin = $this->request->getPost("last_login");
        $user->lastAction = $this->request->getPost("last_action");
        $user->isAdmin = $this->request->getPost("is_admin");
        $user->created = $this->request->getPost("created");
        $user->modified = $this->request->getPost("modified");
        $user->language = $this->request->getPost("language");
        $user->applicationId = $this->request->getPost("application_id", "int");
        $user->stripeId = $this->request->getPost("stripe_id");
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'edit',
                'params' => [$user->id]
            ]);

            return;
        }

        $this->flash->success("user was updated successfully");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = User::findFirstByid($id);
        if (!$user) {
            $this->flash->error("user was not found");

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("user was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "user",
            'action' => "index"
        ]);
    }
}
