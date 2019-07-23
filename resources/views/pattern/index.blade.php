@extends(Auth::check()?'layouts.dashboard':'layouts.app')
@section('content')
        @if(!Auth::check())
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
            <script src="{{ asset('js/app.js') }}"></script>
            <script src="{{ asset('js/all.js') }}"></script>
        @endif
        <div class="row" ng-app="app" ng-controller="patternController">
        <div class="page-header">
            <h1>Padronização
                <small> Lista de documentos</small>
            </h1>
        </div>
        @can('admin')
        <div class="col-md-12">
            <div class="panel-body">
                <button class="btn btn-default" data-toggle="modal" data-target="#newCategory">Novo</button>
            </div>
        </div>
        @endcan


            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Pesquisa</strong>
                </div>
                <div class="panel-body">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select class="form-control" ng-model="search.type">
                                <option value="fluxogramas">Fluxogramas</option>
                                <option value="impressos">Impressos</option>
                                <option value="Manuais">Manuais</option>
                                <option value="SIPOC">SIPOC</option>
                                <option value="Procedimentos">Procedimentos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>&nbsp</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon3">Pesquisa de documentos</span>
                                <input type="text" class="form-control"  ng-model="search.title">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Disciplina</label>
                            <select class="form-control" ng-model="search.discipline_id"
                                    ng-options="discipline.id as discipline.description for discipline in disciplines"
                                    ng-change="getSubDiscipline(search.discipline_id)"
                            ></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Sub disciplina</label>
                            <select class="form-control"
                                    ng-change="getCategory(search.discipline_id,search.sub_discipline_id)"
                                    ng-options="subDiscipline.id as subDiscipline.description for subDiscipline in subDisciplines"
                                    ng-model="search.sub_discipline_id"></select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select class="form-control"
                                    categories
                                    ng-options="category.id as category.description for category in categories"
                                    ng-model="search.categorization_id"></select>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped hover">
                <thead>
                <th>Tipo</th>
                <th>Titulo</th>
                <th>Disciplina</th>
                <th>Sub-Disciplina</th>
                <th>Categoria</th>
                <th>Versão</th>
                <th>Revisão</th>
                <th></th>
                </thead>
                <tbody ng-repeat="document in documents | filter:search">
                <tr>
                    <td><span ng-bind="document.type" ng-cloak></span></td>
                    <td ng-bind="document.title" ng-cloak></td>
                    <td ng-bind="document.discipline.description" ng-cloak></td>
                    <td ng-bind="document.sub_discipline.description" ng-cloak></td>
                    <td ng-bind="document.category.description" ng-cloak></td>
                    <td ng-bind="document.version" ng-cloak></td>
                    <td ng-bind="document.review" ng-cloak></td>
                    <td>
                        @can('admin')
                            <button class="btn btn-danger btn-xs">
                                <span class="glyphicon glyphicon-trash" ng-click="delete(document)"></span>
                            </button>
                            <button class="btn btn-default btn-xs" ng-click="edit(document)">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        @endcan
                        <a href="/document/@{{ document.id }}" class="btn btn-default btn-xs" target="_blank">
                            <span class="glyphicon glyphicon-download" ></span>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="modal fade" id="newCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Nova Categoria</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" ng-model="document.type">
                                            <option value="fluxogramas">Fluxogramas</option>
                                            <option value="impressos">Impressos</option>
                                            <option value="Manuais">Manuais</option>
                                            <option value="SIPOC">SIPOC</option>
                                            <option value="Procedimentos">Procedimentos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Titulo</label>
                                        <input type="text" class="form-control" name="name" id="name" required ng-model="document.title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Disciplina</label>
                                        <select class="form-control" ng-model="document.discipline_id"
                                                ng-options="discipline.id as discipline.description for discipline in disciplines"
                                                ng-change="getSubDiscipline(document.discipline_id)"
                                        ></select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Sub disciplina</label>
                                        <select class="form-control"
                                                ng-change="getCategory(document.discipline_id,document.sub_discipline_id)"
                                                ng-options="subDiscipline.id as subDiscipline.description for subDiscipline in subDisciplines"
                                                ng-model="document.sub_discipline_id"></select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control"
                                                categories
                                                ng-options="category.id as category.description for category in categories"
                                                ng-model="document.categorization_id"></select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sequencial</label>
                                        <input type="text" class="form-control"  ng-model="document.sequential">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Resisão</label>
                                        <input type="text" class="form-control" ng-model="document.review">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Arquivo</label>
                                        <input type="file" class="form-control" files-input ng-model="document.file" name="file">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary insertCategory" ng-click="save(document,file)">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Categoria</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select class="form-control" ng-model="document.type">
                                            <option value="fluxogramas">Fluxogramas</option>
                                            <option value="impressos">Impressos</option>
                                            <option value="Manuais">Manuais</option>
                                            <option value="SIPOC">SIPOC</option>
                                            <option value="Procedimentos">Procedimentos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Titulo</label>
                                        <input type="text" class="form-control" name="name" id="name" required ng-model="document.title">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Disciplina</label>
                                        <select class="form-control" ng-model="document.discipline_id"
                                                ng-options="discipline.id as discipline.description for discipline in disciplines"
                                                ng-change="getSubDiscipline(document.discipline_id)"
                                        ></select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Sub disciplina</label>
                                        <select class="form-control"
                                                ng-change="getCategory(document.discipline_id,document.sub_discipline_id)"
                                                ng-options="subDiscipline.id as subDiscipline.description for subDiscipline in subDisciplines"
                                                ng-model="document.sub_discipline_id"></select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select class="form-control"
                                                categories
                                                ng-options="category.id as category.description for category in categories"
                                                ng-model="document.categorization_id"></select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sequencial</label>
                                        <input type="text" class="form-control"  ng-model="document.sequential">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Revisão</label>
                                        <input type="text" class="form-control" ng-model="document.review">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Arquivo</label>
                                        <input type="file" class="form-control" files-input ng-model="document.file" name="file">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary insertCategory" ng-click="update(document)">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

