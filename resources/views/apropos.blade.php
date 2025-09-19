<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - PlumeUP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        plume: {
                            yellow: '#EAB308',
                            orange: '#F97316',
                            dark: '#1F2937'
                        }
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-white text-gray-800">

    <!-- Section principale -->
    <section class="bg-white py-16 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-plume-orange mb-6">À propos de PlumeUP</h1>
            <p class="text-lg text-gray-700 leading-relaxed">
                PlumeUP est une plateforme dédiée à la valorisation de la créativité littéraire, particulièrement celle des jeunes auteurs.
                Elle offre un espace où chacun peut écrire, publier, lire et partager des œuvres originales.
            </p>
        </div>
    </section>

    <!-- Mission & Objectifs -->
    <section class="bg-gray-50 py-16 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Mission -->
            <div>
                <h2 class="text-2xl font-bold text-plume-yellow mb-4">Notre mission</h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    Rendre la lecture et l'écriture accessibles à tous, sans barrière, et créer un pont entre les jeunes auteurs et les lecteurs du monde entier.
                    Nous croyons que chaque voix mérite d’être entendue, chaque plume a une histoire à raconter.
                </p>
            </div>

            <!-- Objectifs -->
            <div>
                <h2 class="text-2xl font-bold text-plume-yellow mb-4">Nos objectifs</h2>
                <ul class="list-disc list-inside text-gray-700 text-lg leading-relaxed space-y-2">
                    <li>Favoriser l’émergence de nouveaux talents littéraires.</li>
                    <li>Permettre une diffusion facile et gratuite des œuvres.</li>
                    <li>Créer une communauté active de lecteurs et d’écrivains.</li>
                    <li>Offrir une expérience utilisateur fluide, immersive et sans publicité intrusive.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Communauté -->
    <section class="py-16 px-6 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-plume-orange mb-4">Une communauté littéraire engagée</h2>
            <p class="text-gray-700 text-lg leading-relaxed mb-6">
                Chaque membre de PlumeUP, qu’il soit lecteur ou auteur, contribue à faire vivre un univers riche, passionné et bienveillant.
                Les commentaires, les notes et les partages renforcent les liens et motivent les écrivains à continuer leur passion.
            </p>
            <a href="#" class="bg-plume-yellow text-black px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                Rejoignez la communauté
            </a>
        </div>
    </section>

    <!-- Origine -->
    <section class="py-16 px-6 bg-gray-100">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-plume-orange mb-4">Créé avec passion au Bénin 🇧🇯</h2>
            <p class="text-gray-700 text-lg leading-relaxed">
                PlumeUP est une initiative 100% béninoise portée par des passionnés de littérature et de technologie.
                Notre ambition est de faire rayonner les plumes africaines et francophones dans le monde entier.
            </p>
        </div>
    </section>
</body>
</html>