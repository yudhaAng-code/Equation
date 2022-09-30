# Equation

![Current Version](https://img.shields.io/badge/version-v1.0.0-blue)
![GitHub contributors](https://img.shields.io/github/contributors/yudhaAng-code/Equation)
![GitHub stars](https://img.shields.io/github/stars/yudhaAng-code/Equation?style=social)
![GitHub forks](https://img.shields.io/github/forks/yudhaAng-code/Equation?style=social)
![Twitter Follow](https://img.shields.io/twitter/follow/yudhaAng?style=social)

Equation is php library for conversion qty by conversion ladder of units.

## Table of Contents
- [Getting Started](#getting-started)
	- [Requirement](#requirement)
	- [Project Structure](#project-structure)
	- [Installation](#installation)
- [Basic Usage](#basic-usage)
	- [Use the class](#use-the-class)
	- [Function And Method](#function-and-method)
- [Authors](#authors)
- [License](#license)

## Getting Started
### Requirement
* PHP Version >= 7.4
* Composer

### Project Structure
```
Equation
├── src
│	├── Data
│	│	└── DefaultUnit.php
│	├── Example
│	│	├── data.json
│	│	└── index.php
│	└── Equation.php
├── .gitignore
├── composer.json
├── LICENSE
└── README.md
```
### Installation
```
    composer require yudhaang/equation
```
## Basic Usage

### Use the class
Include the class into your php file and initialize to variable.

* Open your file in your project :
    `example : path_of_your_project/index.php`
* Write this code to include the class :
    ```
    <?php
    require __DIR__ . '/vendor/autoload.php';
    use yudhaAng/Equation;
    ```
* Initialize object variable :
    ```
    $units_data = [
        ['name'=>'kg', 'qty' => 1],
        ['name'=>'hg', 'qty' => 10],
        ['name'=>'dag', 'qty' => 10],
        ['name'=>'g', 'qty' => 10],
        ['name'=>'dg', 'qty' => 10],
        ['name'=>'mg', 'qty' => 10]
    ];
    $options = [
        'units' => $units_data
    ];
    $equation = new Equation($options);
    ```
    
### Function and Method
* Convert
    ```
    $equation = new Equation($options);
    
    $qty = 1.745;
    $from_unit = 'kg';
    $to_unit = 'g';
    $output = $equation->convert($qty, $from_unit, $to_unit); 
    // Output Number = 1745
    
    $qty = 1245;
    $from_unit = 'g';
    $to_unit = 'dag';
    $output = $equation->convert($qty, $from_unit, $to_unit); 
    // Output Number = 124.5
    ```
* Render Text
    ```
    $equation = new Equation($options);
    
    $qty = 1.745;
    $unit = 'kg';
    $output = $equation->renderText($qty, $unit);
    // Output String = 1 kg, 7 hg, 4 dag, 5 g
    ```
* Convert Text
    ```
    $equation = new Equation($options);
    
    // Unspecific unit output
    $text = '1 kg, 7 hg, 4 dag, 5 g';
    $output = $equation->converText($text);
    // Output Array = ['kg'=>1.745, 'hg'=>17.45, 'dag'=>174.5, 'g'=>1745, 'dg'=>17450, 'cg'=>174500, 'mg'=>1745000]
    
    // Specific unit output
    $text = '1 kg, 7 hg, 4 dag, 5 g';
    $unit = 'g';
    $output = $equation->converText($text, $unit);
    // Output Number = 1745
    ```

## Authors

#### Yudha Angga Wijaya
* [GitHub]
* [LinkedIn]

## License

`Equation` is open source software [licensed as MIT][license].


[//]: # (HyperLinks)

[GitHub Repository]: https://github.com/yudhaAng-code/Equation
[GitHub Pages]: https://yudhaAng-code.github.io/Equation
[tags]: https://github.com/yudhaAng-code/Equation/tags

[GitHub]: https://github.com/yudhaAng-code
[LinkedIn]: https://www.linkedin.com/in/yudha-angga-wijaya-75453a80

[contributors]: https://github.com/yudhaAng-code/Equation/contributors
[license]: https://github.com/yudhaAng-code/Equation/blob/master/LICENSE