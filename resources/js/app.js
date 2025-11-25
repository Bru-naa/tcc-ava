import './bootstrap';               
import Alpine from 'alpinejs';    
import 'preline';
import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import Chart from 'chart.js/auto';
/* import Dropzone from "dropzone"; */

window.Alpine = Alpine;
Alpine.start();


//Dashboard professor----
document.addEventListener("DOMContentLoaded", () => {
    
    // GRÁFICO 1 - Participação nas Atividades (Pizza)
    const ctx1 = document.getElementById('participacaoChart');
    if (ctx1) {
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Não', 'A maioria das vezes', 'Sempre participo'],
                datasets: [{
                    data: [15, 35, 50],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(245, 158, 11)',
                        'rgb(16, 185, 129)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // GRÁFICO 2 - Dificuldades no Ensino (Barras Horizontais)
    const ctx2 = document.getElementById('dificuldadesChart');
    if (ctx2) {
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [
                    'Ritmo da aula',
                    'Explicação rápida',
                    'Poucos exemplos',
                    'Conteúdo desorganizado',
                    'Nenhuma dificuldade'
                ],
                datasets: [{
                    data: [25, 30, 40, 15, 10],
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 2
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantidade de Respostas'
                        }
                    }
                }
            }
        });
    }

    // GRÁFICO 3 - Conforto com Dúvidas (Doughnut)
    const ctx3 = document.getElementById('duvidasChart');
    if (ctx3) {
        new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: ['Não', 'Às vezes', 'Sim'],
                datasets: [{
                    data: [20, 45, 35],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(16, 185, 129, 0.7)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // GRÁFICO 4 - Coerência das Avaliações (Barras)
    const ctx4 = document.getElementById('avaliacoesChart');
    if (ctx4) {
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Sim, totalmente', 'Em sua maioria', 'Parcialmente', 'Não reflete'],
                datasets: [{
                    data: [35, 40, 15, 10],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(239, 68, 68, 0.7)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Respostas'
                        }
                    }
                }
            }
        });
    }

});

document.addEventListener("DOMContentLoaded", () => {
    const ctx = document.getElementById('radarChart');
    if (ctx) {
        const data = {
            labels: [
                'Ritmo da Aula',
                'Clareza na Explicação', 
                'Exemplos Práticos',
                'Organização do Conteúdo',
                'Disponibilidade para Dúvidas',
                'Coerência das Avaliações'
            ],
            datasets: [
                {
                    label: 'Perfil Atual',
                    data: [65, 40, 30, 75, 60, 45],
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgb(59, 130, 246)',
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(59, 130, 246)',
                    fill: true
                },
                {
                    label: 'Meta Ideal',
                    data: [80, 85, 90, 85, 95, 90],
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderColor: 'rgb(16, 185, 129)',
                    pointBackgroundColor: 'rgb(16, 185, 129)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(16, 185, 129)',
                    fill: true
                }
            ]
        };

        const config = {
            type: 'radar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    filler: {
                        propagate: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${context.raw}%`;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest'
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            callback: function(value) {
                                return value + '%';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        angleLines: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        pointLabels: {
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            color: 'rgba(75, 85, 99, 0.9)'
                        }
                    }
                },
                elements: {
                    line: {
                        borderWidth: 2,
                        tension: 0.1
                    },
                    point: {
                        radius: 4,
                        hoverRadius: 6
                    }
                }
            }
        };

        new Chart(ctx, config);
    }
});