<?php namespace ApiGfccm\Http\Controllers\Api\Transformers;

use ApiGfccm\Models\IncomeService;
use ApiGfccm\Models\IncomeServiceMemberFundTotal;
use League\Fractal\TransformerAbstract;

class IncomeServiceTransformer extends TransformerAbstract
{
    /**
     * @param IncomeService $incomeService
     * @return array
     */
    public function transform(IncomeService $incomeService)
    {
        return [
            'id' => (int) $incomeService->id,
            'service_id' => $incomeService->service_id,
            'tithes' => $incomeService->tithes,
            'offering' => $incomeService->offering,
            'other_fund' => $incomeService->other_fund,
            'total' => $incomeService->total,
            'service_date' => $incomeService->service_date,
            'status' => $incomeService->status,
            'created_by' => $incomeService->created_by,
            'role_access' => $incomeService->role_access,
            'service' => $incomeService->service->name,
            'user' => $incomeService->user->username,
            'funds_structure' => $this->getStructure(
                $incomeService->fund_structure,
                new IncomeServiceFundStructureTransformer()),
            'denominations_structure' => $this->getStructure(
                $incomeService->denomination_structure,
                new IncomeServiceDenominationStructureTransformer()),
            'member_fund_total' => $this->getFundTotal($incomeService->member_fund_total)
        ];
    }

    /**
     * Get Structures
     *
     * @param $structures
     * @param $transformer
     * @return array
     */
    private function getStructure($structures, $transformer)
    {
        $transformedStructures = [];

        foreach ($structures as $structure) {
            $transformedStructures[] = $transformer->transform($structure);
        }

        return $transformedStructures;
    }

    private function getFundTotal($incomeService)
    {
        $memberFundTotal = [];
        $memberFundTotalTransformer = new IncomeServiceMemberFundTotalTransformer();

        foreach ($incomeService as $memberTotal) {
            $memberFundTotal[] = $memberFundTotalTransformer->transform($memberTotal);
        }

        return $memberFundTotal;
    }

}