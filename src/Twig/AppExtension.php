<?php
    // src/Twig/AppExtension.php
    namespace App\Twig;

    use Twig\Extension\AbstractExtension;
    use Twig\TwigFunction;

    class AppExtension extends AbstractExtension
    {
        public function getFunctions()
        {
            return [
                new TwigFunction('placeCards', [$this, 'cardConstruction']),
            ];
        }

        public function cardConstruction($card)
        {
            echo "
            <div class='col'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>".$card->getHeader()."</h5>
                        <p class='card-text'>".$card->getBodydescription()."</p>
                        <a class='card-open text-muted card_".$card->getId()."' data-bs-toggle='modal' data-bs-target='#exampleModal' type='button'>Открыть</a>
                    </div>
                </div>
            </div>";
        }
    }
?>