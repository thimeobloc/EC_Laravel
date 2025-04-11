<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie Commune') }}
            </span>
        </h1>
    </x-slot>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 items-start">

        <!-- Bloc Tâches Urgentes -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Tâches Urgentes</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Ces tâches doivent être réalisées dans les plus brefs délais :</p>

                <div class="space-y-3">
                    <!-- Exemple de tâche urgente -->
                    <div class="border rounded-lg p-4 shadow-sm bg-red-50">
                        <div class="font-semibold">Organiser une réunion</div>
                        <div class="text-sm text-gray-600">Préparer l'agenda et inviter les membres</div>
                        <div class="text-sm text-gray-600">Échéance : 15 Avril 2025</div>

                        <!-- Statut de la tâche -->
                        <div class="mt-2">
                            <span class="text-red-600">Urgente</span>
                        </div>

                        <!-- Bouton pour marquer la tâche comme terminée -->
                        <div class="mt-3 text-right">
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-sm btn-success">Marquer comme terminée</button>
                            </form>
                        </div>

                        <!-- Nom de l'élève ayant effectué la tâche -->
                        <div class="mt-2">
                            <span class="text-gray-600">Réalisé par : John Doe</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bloc Tâches Normales -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Tâches Normales</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Ces tâches doivent être complétées dans un délai raisonnable :</p>

                <div class="space-y-3">
                    <!-- Exemple de tâche normale -->
                    <div class="border rounded-lg p-4 shadow-sm bg-yellow-50">
                        <div class="font-semibold">Nettoyer les espaces communs</div>
                        <div class="text-sm text-gray-600">Passer l'aspirateur dans le couloir et les salles communes</div>
                        <div class="text-sm text-gray-600">Échéance : 20 Avril 2025</div>

                        <!-- Statut de la tâche -->
                        <div class="mt-2">
                            <span class="text-yellow-600">Normale</span>
                        </div>

                        <!-- Bouton pour marquer la tâche comme terminée -->
                        <div class="mt-3 text-right">
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-sm btn-success">Marquer comme terminée</button>
                            </form>
                        </div>

                        <!-- Nom de l'élève ayant effectué la tâche -->
                        <div class="mt-2">
                            <span class="text-gray-600">Réalisé par : Jane Smith</span>
                        </div>
                    </div>

                    <!-- Exemple de tâche normale 2 -->
                    <div class="border rounded-lg p-4 shadow-sm bg-yellow-50">
                        <div class="font-semibold">Organiser un événement social</div>
                        <div class="text-sm text-gray-600">Préparer le programme et les invitations</div>
                        <div class="text-sm text-gray-600">Échéance : 30 Avril 2025</div>

                        <!-- Statut de la tâche -->
                        <div class="mt-2">
                            <span class="text-yellow-600">Normale</span>
                        </div>

                        <!-- Bouton pour marquer la tâche comme terminée -->
                        <div class="mt-3 text-right">
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-sm btn-success">Marquer comme terminée</button>
                            </form>
                        </div>

                        <!-- Nom de l'élève ayant effectué la tâche -->
                        <div class="mt-2">
                            <span class="text-gray-600">Réalisé par : Alice Dupont</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bloc Tâches Terminées -->
        <div class="card h-full">
            <div class="card-header justify-between">
                <h3 class="card-title">Tâches Terminées</h3>
            </div>
            <div class="card-body space-y-4">
                <p class="text-sm text-gray-600">Ces tâches ont été complétées avec succès :</p>

                <div class="space-y-3">
                    <!-- Exemple de tâche terminée -->
                    <div class="border rounded-lg p-4 shadow-sm bg-green-50">
                        <div class="font-semibold">Réunion de planification</div>
                        <div class="text-sm text-gray-600">Discuter des priorités pour le mois suivant</div>
                        <div class="text-sm text-gray-600">Échéance : 10 Avril 2025</div>

                        <!-- Statut de la tâche -->
                        <div class="mt-2">
                            <span class="text-green-600">Terminée</span>
                        </div>

                        <!-- Bouton pour marquer la tâche comme terminée -->
                        <div class="mt-3 text-right">
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-sm btn-success" disabled>Terminée</button>
                            </form>
                        </div>

                        <!-- Nom de l'élève ayant effectué la tâche -->
                        <div class="mt-2">
                            <span class="text-gray-600">Réalisé par : Marc Lefevre</span>
                        </div>
                    </div>

                    <!-- Exemple de tâche terminée 2 -->
                    <div class="border rounded-lg p-4 shadow-sm bg-green-50">
                        <div class="font-semibold">Réparer la porte du réfectoire</div>
                        <div class="text-sm text-gray-600">Faire appel au réparateur pour réparer la porte</div>
                        <div class="text-sm text-gray-600">Échéance : 5 Avril 2025</div>

                        <!-- Statut de la tâche -->
                        <div class="mt-2">
                            <span class="text-green-600">Terminée</span>
                        </div>

                        <!-- Bouton pour marquer la tâche comme terminée -->
                        <div class="mt-3 text-right">
                            <form action="#" method="POST">
                                <button type="submit" class="btn btn-sm btn-success" disabled>Terminée</button>
                            </form>
                        </div>

                        <!-- Nom de l'élève ayant effectué la tâche -->
                        <div class="mt-2">
                            <span class="text-gray-600">Réalisé par : Lucas Martin</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
