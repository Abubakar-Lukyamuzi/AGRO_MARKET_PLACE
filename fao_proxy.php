<?php
// FAO API Proxy - Simplified version without cURL dependency
// This script acts as a middleware between the client and the FAO APIs
// to avoid CORS issues when accessing the APIs directly from JavaScript

// Allow from any origin
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

// Get the API endpoint from the query parameter
$api = isset($_GET['api']) ? $_GET['api'] : '';
$query = isset($_GET['q']) ? $_GET['q'] : '';

// Just return sample data - this is the most reliable approach
// for a demo environment where external API access may be limited
if ($api === 'agrovoc') {
    // Filter sample data based on query
    $queryLower = strtolower($query);
    
    // Full dataset
    $allTerms = [
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_203',
            'prefLabel' => 'Rice',
            'definition' => 'Annual cereal grass widely cultivated in warm climates, especially in Asia.',
            'narrower' => ['Brown rice', 'White rice', 'Paddy']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_7951',
            'prefLabel' => 'Wheat',
            'definition' => 'One of the oldest and most important cereal crops.',
            'narrower' => ['Durum wheat', 'Common wheat', 'Ancient wheat']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_12332',
            'prefLabel' => 'Maize',
            'definition' => 'Cereal plant having large kernels on a cob, also known as corn.',
            'narrower' => ['Sweet corn', 'Field corn', 'Popcorn']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_330',
            'prefLabel' => 'Vegetables',
            'definition' => 'Edible plants or parts of plants cultivated for food.',
            'narrower' => ['Leafy vegetables', 'Root vegetables', 'Fruit vegetables']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_3128',
            'prefLabel' => 'Fruits',
            'definition' => 'The edible ripened ovaries of a plant, including seeds within.',
            'narrower' => ['Tropical fruits', 'Citrus fruits', 'Berries']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_4830',
            'prefLabel' => 'Legumes',
            'definition' => 'Plants of the family Fabaceae or their seeds used for food.',
            'narrower' => ['Beans', 'Lentils', 'Peas']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_8078',
            'prefLabel' => 'Coffee',
            'definition' => 'Beverage prepared from roasted coffee beans.',
            'narrower' => ['Arabica coffee', 'Robusta coffee']
        ],
        [
            'uri' => 'http://aims.fao.org/aos/agrovoc/c_7691',
            'prefLabel' => 'Tea',
            'definition' => 'Aromatic beverage prepared by infusing tea leaves in hot water.',
            'narrower' => ['Green tea', 'Black tea', 'Herbal tea']
        ]
    ];
    
    // Filter results based on query
    $filteredTerms = [];
    foreach ($allTerms as $term) {
        // Match on prefLabel or narrower terms
        if (
            strpos(strtolower($term['prefLabel']), $queryLower) !== false || 
            strpos(strtolower($term['definition']), $queryLower) !== false
        ) {
            $filteredTerms[] = $term;
            continue;
        }
        
        // Check narrower terms
        foreach ($term['narrower'] as $narrower) {
            if (strpos(strtolower($narrower), $queryLower) !== false) {
                $filteredTerms[] = $term;
                break;
            }
        }
    }
    
    // If no matches or empty query, return all
    if (empty($filteredTerms) || empty($query)) {
        $filteredTerms = $allTerms;
    }
    
    // Return formatted response
    echo json_encode(['results' => $filteredTerms]);
} else {
    // FAOSTAT data
    $allCrops = [
        [
            'code' => '15',
            'item' => 'Wheat',
            'element' => 'Production',
            'value' => 760570042,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'World'
        ],
        [
            'code' => '27',
            'item' => 'Rice',
            'element' => 'Production',
            'value' => 756743719,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Asia'
        ],
        [
            'code' => '56',
            'item' => 'Maize',
            'element' => 'Production',
            'value' => 1162427138,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Americas'
        ],
        [
            'code' => '116',
            'item' => 'Potatoes',
            'element' => 'Production',
            'value' => 359071391,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Europe'
        ],
        [
            'code' => '236',
            'item' => 'Soybeans',
            'element' => 'Production',
            'value' => 353464796,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Americas'
        ],
        [
            'code' => '181',
            'item' => 'Sugar cane',
            'element' => 'Production',
            'value' => 1889278602,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Global'
        ],
        [
            'code' => '328',
            'item' => 'Coffee, green',
            'element' => 'Production',
            'value' => 10270062,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Africa'
        ],
        [
            'code' => '156',
            'item' => 'Tomatoes',
            'element' => 'Production',
            'value' => 186820086,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Mediterranean'
        ],
        [
            'code' => '486',
            'item' => 'Bananas',
            'element' => 'Production',
            'value' => 119823933,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Tropical'
        ],
        [
            'code' => '426',
            'item' => 'Apples',
            'element' => 'Production',
            'value' => 86442518,
            'unit' => 'tonnes',
            'year' => '2022',
            'area' => 'Temperate'
        ]
    ];
    
    // Filter crops based on query
    $queryLower = strtolower($query);
    $filteredCrops = [];
    
    foreach ($allCrops as $crop) {
        if (
            strpos(strtolower($crop['item']), $queryLower) !== false ||
            strpos(strtolower($crop['area']), $queryLower) !== false
        ) {
            $filteredCrops[] = $crop;
        }
    }
    
    // If no matches or empty query, return all
    if (empty($filteredCrops) || empty($query)) {
        $filteredCrops = $allCrops;
    }
    
    // Return formatted response
    echo json_encode(['data' => $filteredCrops]);
}
?> 