<?php

namespace App\Views\Abilities;

class Menu
{

    private $m;
    private $v;
    private $c;

    public function __construct($controller, $data, $template)
    {
        $this->m = $data;
        $this->v = $template;
        $this->c = $controller;
    }

    public function __toString()
    {
        $ret = '';
        foreach ($this->m as $sections) {
            foreach ($sections as $reference => $section) {
                if (isset($section['subs'])) {
                    $ret .= $this->menuDropdownItem($reference, $section);
                } else {
                    $ret .= $this->menuItem($reference, $section);
                }
            }
            $ret .= $this->spacer();
        }

        return $ret;
    }

    private function spacer()
    {
        return '<li class="nav-item w-100"><hr></li>';
    }

    private function menuDropdownItem($reference, $options)
    {
        $linkClass = $dropdownReference = $dropdownClass = $icon = $subSections = '';

        $label = $options['label'] ?? $reference;

        if (isset($options['icon']))
            $icon = $this->v->icon($options['icon'], 18, ['class' => 'nav-link-icon']);

        if ($this->c->activeSection() == $reference)
            $linkClass = 'active';

        if ($this->c->activeSection() == $reference)
            $dropdownClass = 'show';

        $dropdownReference = $reference . 'Dropdown';

        $ret = '
    <li class="nav-item dropdown">
        <a class="nav-link ' . $linkClass . '" href="#' . $dropdownReference . '" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="' . $dropdownReference . '">
            ' . $icon . '
            <span>' . $label . '</span>
        </a>
        <div class="collapse ' . $dropdownClass . '" id="' . $dropdownReference . '">
        <ul class="nav flex-column">
            %s
        </ul>
        </div>
    </li>';

        return sprintf($ret, $this->subMenuItems($options['subs']));
    }

    private function subMenuItems($items)
    {
        $ret = '';
        foreach ($items as $reference => $options) {
            $ret .= $this->menuItem($reference, $options);
        }
        return $ret;
    }

    private function menuItem($reference, $options)
    {
        $linkClass = $route = $icon = $label = '';

        $label = $options['label'] ?? $reference;

        $item_pattern = '<li class="nav-item"><a href="%s" class="nav-link %s">%s<span>%s</span></a></li>';

        if (isset($reference)) {
            $route = $this->c->urlFor($reference, 'list');

            if ($this->c->activeLink() == $reference)
                $linkClass = 'active';
        }

        if (isset($options['href'])) {
            $route = $options['href'];
        }

        if (isset($options['icon']))
            $icon = $this->v->icon($options['icon'], 18, ['class' => 'nav-link-icon']);



        return sprintf($item_pattern, $route, $linkClass, $icon, $label);
    }
}
