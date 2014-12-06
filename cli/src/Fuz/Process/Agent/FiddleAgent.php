<?php

namespace Fuz\Process\Agent;

use Fuz\Component\SharedMemory\SharedMemory;
use Fuz\AppBundle\Entity\Fiddle;
use Fuz\Process\Entity\Error;
use Fuz\Process\Service\ErrorManager;
use Fuz\Process\TwigEngine\TwigEngineInterface;

class FiddleAgent
{

    /**
     * Error Management service
     *
     * @var ErrorManager
     */
    protected $errorManager;

    /**
     * Execution's environment ID
     *
     * @var string
     */
    protected $environmentId;

    /**
     * Fiddles taken from debug directory?
     *
     * @var bool
     */
    protected $isDebug;

    /**
     * Execution's environment directory
     *
     * @var string|null
     */
    protected $directory = null;

    /**
     * User's fiddle
     *
     * @var Fiddle
     */
    protected $fiddle;

    /**
     * Execution error(s)
     *
     * @var Error[]
     */
    protected $errors = array ();

    /**
     * Variable shared with web application
     *
     * @var SharedMemory
     */
    protected $sharedMemory;

    /**
     * Twig Engine for the right Twig's version
     *
     * @var TwigEngineInterface
     */
    protected $engine;

    /**
     * Twig's source directory for the requested version
     *
     * @var string
     */
    protected $sourceDirectory;

    /**
     * Fiddle's context converted to array
     *
     * @var mixed[]|null
     */
    protected $context = null;

    /**
     * List templates full paths
     *
     * @var string[]|null
     */
    protected $templates = null;

    /**
     * Fiddle's result
     *
     * @var string|null
     */
    protected $result = null;

    /**
     * Compiled templates
     *
     * @var array[]
     */
    protected $compiled = array ();

    public function __construct(ErrorManager $errorManager)
    {
        $this->errorManager = $errorManager;
    }

    public function setEnvironmentId($environmentId)
    {
        $this->environmentId = $environmentId;
        return $this;
    }

    public function getEnvironmentId()
    {
        return $this->environmentId;
    }

    public function setIsDebug($isDebug)
    {
        $this->isDebug = $isDebug;
        return $this;
    }

    public function isDebug()
    {
        return $this->isDebug;
    }

    public function setDirectory($directory)
    {
        $this->directory = $directory;
        return $this;
    }

    public function getDirectory()
    {
        return $this->directory;
    }

    public function setFiddle(Fiddle $fiddle)
    {
        $this->fiddle = $fiddle;
        return $this;
    }

    public function getFiddle()
    {
        return $this->fiddle;
    }

    public function addError($error)
    {
        if (!($error instanceof Error))
        {
            if ($this->errorManager)
            {
                return $this->addError($this->errorManager->getError($error, array_slice(func_get_args(), 1)));
            }
            else
            {
                throw new \LogicException("Unserialized agent cannot be reused at runtime.");
            }
        }
        $this->errors[] = $error;
        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setSharedMemory(SharedMemory $sharedMemory)
    {
        $this->sharedMemory = $sharedMemory;
        return $this;
    }

    public function getSharedMemory()
    {
        return $this->sharedMemory;
    }

    public function setEngine(TwigEngineInterface $engine)
    {
        $this->engine = $engine;
        return $this;
    }

    public function getEngine()
    {
        return $this->engine;
    }

    public function setSourceDirectory($sourceDirectory)
    {
        $this->sourceDirectory = $sourceDirectory;
        return $this;
    }

    public function getSourceDirectory()
    {
        return $this->sourceDirectory;
    }

    public function setContext(array $context)
    {
        $this->context = $context;
        return $this;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
        return $this;
    }

    public function getTemplates()
    {
        return $this->templates;
    }

    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setCompiled(array $compiled)
    {
        $this->compiled = $compiled;
        return $this;
    }

    public function getCompiled()
    {
        return $this->compiled;
    }

    public function __sleep()
    {
        return array_diff(array_keys(get_object_vars($this)), array('errorManager', 'engine'));
    }

    public function __wakeup()
    {
        $this->errorManager = null;
    }

}