<?php

namespace A2htray\GDBChado\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class GenerateChadoModelCommand extends Command
{
    private $tableNames = [
        'acquisition',
        'acquisitionprop',
        'acquisition_relationship',
        'analysis',
        'analysis_cvterm',
        'analysis_dbxref',
        'analysisfeature',
        'analysisfeatureprop',
        'analysis_organism',
        'analysisprop',
        'analysis_pub',
        'analysis_relationship',
        'arraydesign',
        'arraydesignprop',
        'assay',
        'assay_biomaterial',
        'assay_project',
        'assayprop',
        'biomaterial',
        'biomaterial_dbxref',
        'biomaterialprop',
        'biomaterial_relationship',
        'biomaterial_treatment',
        'cell_line',
        'cell_line_cvterm',
        'cell_line_cvtermprop',
        'cell_line_dbxref',
        'cell_line_feature',
        'cell_line_library',
        'cell_lineprop',
        'cell_lineprop_pub',
        'cell_line_pub',
        'cell_line_relationship',
        'cell_line_synonym',
        'chadoprop',
        'channel',
        'contact',
        'contactprop',
        'contact_relationship',
        'control',
        'cv',
        'cvprop',
        'cv_root_mview',
        'cvterm',
        'cvterm_dbxref',
        'cvtermpath',
        'cvtermprop',
        'cvterm_relationship',
        'cvtermsynonym',
        'db',
        'dbprop',
        'dbxref',
        'dbxrefprop',
        'eimage',
        'element',
        'element_relationship',
        'elementresult',
        'elementresult_relationship',
        'environment',
        'environment_cvterm',
        'expression',
        'expression_cvterm',
        'expression_cvtermprop',
        'expression_image',
        'expressionprop',
        'expression_pub',
        'feature',
        'feature_contact',
        'feature_cvterm',
        'feature_cvterm_dbxref',
        'feature_cvtermprop',
        'feature_cvterm_pub',
        'feature_dbxref',
        'feature_expression',
        'feature_expressionprop',
        'feature_genotype',
        'featureloc',
        'featureloc_pub',
        'featuremap',
        'featuremap_contact',
        'featuremap_dbxref',
        'featuremap_organism',
        'featuremapprop',
        'featuremap_pub',
        'feature_phenotype',
        'featurepos',
        'featureposprop',
        'featureprop',
        'featureprop_pub',
        'feature_pub',
        'feature_pubprop',
        'featurerange',
        'feature_relationship',
        'feature_relationshipprop',
        'feature_relationshipprop_pub',
        'feature_relationship_pub',
        'feature_synonym',
        'genotype',
        'genotypeprop',
        'library',
        'library_contact',
        'library_cvterm',
        'library_dbxref',
        'library_expression',
        'library_expressionprop',
        'library_feature',
        'library_featureprop',
        'libraryprop',
        'libraryprop_pub',
        'library_pub',
        'library_relationship',
        'library_relationship_pub',
        'library_synonym',
        'magedocumentation',
        'mageml',
        'materialized_view',
        'nd_experiment',
        'nd_experiment_analysis',
        'nd_experiment_contact',
        'nd_experiment_dbxref',
        'nd_experiment_genotype',
        'nd_experiment_phenotype',
        'nd_experiment_project',
        'nd_experimentprop',
        'nd_experiment_protocol',
        'nd_experiment_pub',
        'nd_experiment_stock',
        'nd_experiment_stock_dbxref',
        'nd_experiment_stockprop',
        'nd_geolocation',
        'nd_geolocationprop',
        'nd_protocol',
        'nd_protocolprop',
        'nd_protocol_reagent',
        'nd_reagent',
        'nd_reagentprop',
        'nd_reagent_relationship',
        'organism',
        'organism_cvterm',
        'organism_cvtermprop',
        'organism_dbxref',
        'organism_feature_count',
        'organismprop',
        'organismprop_pub',
        'organism_pub',
        'organism_relationship',
        'phendesc',
        'phenotype',
        'phenotype_comparison',
        'phenotype_comparison_cvterm',
        'phenotype_cvterm',
        'phenotypeprop',
        'phenstatement',
        'phylonode',
        'phylonode_dbxref',
        'phylonode_organism',
        'phylonodeprop',
        'phylonode_pub',
        'phylonode_relationship',
        'phylotree',
        'phylotreeprop',
        'phylotree_pub',
        'project',
        'project_analysis',
        'project_contact',
        'project_dbxref',
        'project_feature',
        'projectprop',
        'project_pub',
        'project_relationship',
        'project_stock',
        'protocol',
        'protocolparam',
        'pub',
        'pubauthor',
        'pubauthor_contact',
        'pub_dbxref',
        'pubprop',
        'pub_relationship',
        'quantification',
        'quantificationprop',
        'quantification_relationship',
        'stock',
        'stockcollection',
        'stockcollection_db',
        'stockcollectionprop',
        'stockcollection_stock',
        'stock_cvterm',
        'stock_cvtermprop',
        'stock_dbxref',
        'stock_dbxrefprop',
        'stock_feature',
        'stock_featuremap',
        'stock_genotype',
        'stock_library',
        'stockprop',
        'stockprop_pub',
        'stock_pub',
        'stock_relationship',
        'stock_relationship_cvterm',
        'stock_relationship_pub',
        'study',
        'study_assay',
        'studydesign',
        'studydesignprop',
        'studyfactor',
        'studyfactorvalue',
        'studyprop',
        'studyprop_feature',
        'synonym',
        'tableinfo',
        'treatment',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gdb-chado:generate-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate models for Chado, you don\'t need to run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $builder = Schema::connection(config('database.default'));
//        var_dump($builder->getColumnListing('db'));
//        $builder->getColumnType('db', 'db_id');
//        foreach ($builder->getColumnListing('db') as $column) {
//            var_dump($column, $builder->getColumnType('db', $column));
//        }
//        exit(0);

        $content = file_get_contents(__DIR__ . '/../../database/chado.model.php.tpl');
        foreach ($this->tableNames as $tableName) {
            $className = implode('', array_map('ucfirst', explode('_', $tableName)));
            $primaryKey = $tableName . '_id';
            $modelFile = __DIR__ . '/../Models/' . $className . '.php';

            if (file_exists($modelFile)) continue;

            $ModelContent = preg_replace_callback_array([
                '/@\{className\}/' => function () use ($className) {
                    return $className;
                },
                '/@\{primaryKey\}/' => function () use ($primaryKey) {
                    return $primaryKey;
                },
                '/@\{tableName\}/' => function () use ($tableName) {
                    return $tableName;
                },
            ], $content);

            file_put_contents($modelFile, $ModelContent);
        }

        return 0;
    }

}
