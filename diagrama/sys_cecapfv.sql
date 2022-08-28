CREATE TABLE `assistances` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `attend` char(1) NOT NULL DEFAULT '0',
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centers`
--

CREATE TABLE `centers` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `schedule_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persons`
--

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `dni` varchar(15) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `person_type_id` int(11) NOT NULL,
  `school` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person_classroom`
--

CREATE TABLE `person_classroom` (
  `id` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `person_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person_types`
--

CREATE TABLE `person_types` (
  `id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `person_types`
--

INSERT INTO `person_types` (`id`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2022-08-24 03:08:58', '2022-08-24 03:08:58'),
(2, 'Profesor', 1, '2022-08-24 03:08:58', '2022-08-24 03:08:58'),
(3, 'Alumno', 1, '2022-08-24 03:09:26', '2022-08-24 03:09:26'),
(4, 'Apoderado', 1, '2022-08-24 03:09:26', '2022-08-24 03:09:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `turno` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `active` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assistances`
--
ALTER TABLE `assistances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_assistances_persons1_idx` (`person_id`),
  ADD KEY `fk_assistances_classes1_idx` (`classroom_id`);

--
-- Indices de la tabla `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `description_UNIQUE` (`description`);

--
-- Indices de la tabla `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_classes_schedules1_idx` (`schedule_id`),
  ADD KEY `fk_classes_courses1_idx` (`course_id`),
  ADD KEY `fk_classes_centers1_idx` (`center_id`),
  ADD KEY `fk_classes_persons1_idx` (`person_id`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `description_UNIQUE` (`description`);

--
-- Indices de la tabla `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_persons_person_types_idx` (`person_type_id`);

--
-- Indices de la tabla `person_classroom`
--
ALTER TABLE `person_classroom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_person_class_persons1_idx` (`person_id`),
  ADD KEY `fk_person_class_classes1_idx` (`classroom_id`);

--
-- Indices de la tabla `person_types`
--
ALTER TABLE `person_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `description_UNIQUE` (`description`);

--
-- Indices de la tabla `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `description_UNIQUE` (`description`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `assistances`
--
ALTER TABLE `assistances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `persons`
--
ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `person_classroom`
--
ALTER TABLE `person_classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `person_types`
--
ALTER TABLE `person_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assistances`
--
ALTER TABLE `assistances`
  ADD CONSTRAINT `fk_assistances_classes1` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assistances_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `fk_classes_centers1` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_classes_courses1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_classes_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_classes_schedules1` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persons`
--
ALTER TABLE `persons`
  ADD CONSTRAINT `fk_persons_person_types` FOREIGN KEY (`person_type_id`) REFERENCES `person_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `person_classroom`
--
ALTER TABLE `person_classroom`
  ADD CONSTRAINT `fk_person_class_classes1` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_person_class_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;