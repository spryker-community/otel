<?php

namespace Pyz\Zed\Catalog\Component\Model\Import\Product\Validator\Workflow\Definition;

use ProjectA\Zed\Catalog\Component\Model\Import\Product\Validator\Workflow\Definition\AbstractDefinition;
use ProjectA\Zed\Library\Workflow\TaskInterface;

class ValidateUpdateSimpleProduct extends AbstractDefinition
{
    /**
     * @return TaskInterface[]
     */
    protected function getTasks()
    {
        return [
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateVarietyExistsTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskSetAttributeSetToContextTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskUpdateValidateNoAttributeSetChangeTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateUnknownFieldsTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateAttributeOptionsExistTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateCategoriesExistTask(),
            $this->factory->createModelImportProductValidatorWorkflowTaskValidateProductOptionsExistTask(),
        ];
    }
}