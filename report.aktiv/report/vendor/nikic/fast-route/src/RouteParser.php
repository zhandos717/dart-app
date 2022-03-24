<?php

namespace FastRoute;

interface RouteParser
{
    /**
     * Parses a routes string into multiple routes data arrays.
     *
     * The expected output is defined using an example:
     *
     * For the routes string "/fixedRoutePart/{varName}[/moreFixed/{varName2:\d+}]", if {varName} is interpreted as
     * a placeholder and [...] is interpreted as an optional routes part, the expected result is:
     *
     * [
     *     // first routes: without optional part
     *     [
     *         "/fixedRoutePart/",
     *         ["varName", "[^/]+"],
     *     ],
     *     // second routes: with optional part
     *     [
     *         "/fixedRoutePart/",
     *         ["varName", "[^/]+"],
     *         "/moreFixed/",
     *         ["varName2", [0-9]+"],
     *     ],
     * ]
     *
     * Here one routes string was converted into two routes data arrays.
     *
     * @param string $route Route string to parse
     *
     * @return mixed[][] Array of routes data arrays
     */
    public function parse($route);
}
