DROP TABLE department;

CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`),
  CONSTRAINT `department_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

INSERT INTO department VALUES("23","6","Department1");
INSERT INTO department VALUES("24","7","General Medicine");
INSERT INTO department VALUES("25","8","General Medicine");
INSERT INTO department VALUES("26","7","General Surgery");
INSERT INTO department VALUES("27","8","General Surgery");



DROP TABLE designation;

CREATE TABLE `designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO designation VALUES("5","Doctor");
INSERT INTO designation VALUES("6","Consultant");
INSERT INTO designation VALUES("7","Registrar");



DROP TABLE group;

;




DROP TABLE leave;

;




DROP TABLE qualification;

CREATE TABLE `qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO qualification VALUES("7","phd");
INSERT INTO qualification VALUES("8","m.phil");
INSERT INTO qualification VALUES("9","MBBS");
INSERT INTO qualification VALUES("10","DNB");
INSERT INTO qualification VALUES("11","Fellowship");



DROP TABLE resource_update;

CREATE TABLE `resource_update` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titleid` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `groupid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `designationid` int(11) NOT NULL,
  `qualification` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `days` text,
  `starttime` text,
  `endtime` text,
  `joiningdate` date NOT NULL,
  `leavingdate` varchar(25) NOT NULL,
  `photo` blob NOT NULL,
  `kmc` varchar(50) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `mail1` varchar(50) NOT NULL,
  `mail2` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `reason` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`groupid`,`departmentid`,`designationid`),
  KEY `departmentid` (`departmentid`),
  KEY `designationid` (`designationid`),
  CONSTRAINT `resource_update_ibfk_1` FOREIGN KEY (`groupid`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `resource_update_ibfk_2` FOREIGN KEY (`departmentid`) REFERENCES `department` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `resource_update_ibfk_3` FOREIGN KEY (`designationid`) REFERENCES `designation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;

INSERT INTO resource_update VALUES("100","4","TEST","6","23","5","m.phil$phd","Fulltime","",",,,,,,,",",,,,,,,","2014-08-12","2014-08-12","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`
INSERT INTO resource_update VALUES("101","4","Pankaja","7","24","6","MBBS","Fulltime","",",,,,,,,",",,,,,,,","2008-08-04","2014-08-12","����\0JFIF\0\0`\0`\0\0��\0C\0		\n
�>o��������ݳvq��+��Ý{�z�����u�.�#I�`�%؝y1��U@\'����y��^��N� ��M��}wM�$��w�RX�$1�gb�6�1����.|C��᫯As�mo-����@�%��pO�G^���|_�����|Ho$���㴉T�y�С ��I8�\'r��V�k�_�o=��^����evڋ:@�\0.A���G�O�:v����t=oY��K*��Q۠;s�\'h����@���������c���\0>_hO;������y�Ӛ�y����Ut��.���渺���$�!󂛲<s�H��|8���-��՝��i6�u�%}Z�n�T���7t;�ža�p8�/�[�-4k�m&0[���j��w,Ь�\"�[B�R�P���h��������wV��{�����p/ٶD$u�L��*��6ޭ��jY��A�-�,��6�D�s$7H�\n���\n0���J�K�߉5m�Vr���6�{��K�K��#q����G8*��>��N׽��-�%o�1�d���L�p��(|�de��OB�f���~o�N�c����%�K�9�v�����5x�A����5�5��G{���@�p��r�O�c�q�\0��n�g�-P�$��Q{4�rȡ�Qm�X�|�%\0�@�3\\�_	��i�C��
�>o��������ݳvq��(���>�������Z�ޥ����\0�|�x�����gA�$��m�-G]���}B��K�[/��#�b�\'#1���sr]wG��>n�c��>ź��s�y|��ܽ3���W�<Eg}cys<�Z��[��^a���X��N6�y,rx#\'�|�Ӵ�4�Nﴝ?�<Mshe�Xȋqز)
INSERT INTO resource_update VALUES("102","4","sheeba","8","25","5","MBBS","Fulltime","",",,,,,,,",",,,,,,,","2013-03-12","2014-08-12","����\0JFIF\0\0`\0`\0\0��\0Exif\0\0II*\0\0\0\0\0\0\0\0\0\0��\0C\0		\n
8Pp+�>�g�����H~��yi�Ǚ��v��v�t�b4�5�s�a�*l���1L������/R��h����?��i�R�H��Rk5l[ۼ+G�1 idv�c,�gMuo�j��ᰚ=e���ؤΟc�Q�#��|dmf~Drp>S��i:����~��٩����-�d1��\nw.ьr=jDд��-m#ҬV��Q=�+n�!�C��\n�$�sɠ?����;[�:]��-�{j��I��A�bF�q��l��1� �j��5q�l����ɌְD/�<�En�\0;o��l�8	�6\'��.��m�4mmRT7RG%�-3�l#q��։��_�����e�4�.P��N����
INSERT INTO resource_update VALUES("104","4","lima","8","25","5","MBBS","Fulltime","",",,,,,,,",",,,,,,,","2011-08-02","2014-08-14","����\0JFIF\0\0`\0`\0\0��\0C\0		\n
�>o��������ݳvq��+��Ý{�z�����u�.�#I�`�%؝y1��U@\'����y��^��N� ��M��}wM�$��w�RX�$1�gb�6�1����.|C��᫯As�mo-����@�%��pO�G^���|_�����|Ho$���㴉T�y�С ��I8�\'r��V�k�_�o=��^����evڋ:@�\0.A���G�O�:v����t=oY��K*��Q۠;s�\'h����@���������c���\0>_hO;������y�Ӛ�y����Ut��.���渺���$�!󂛲<s�H��|8���-��՝��i6�u�%}Z�n�T���7t;�ža�p8�/�[�-4k�m&0[���j��w,Ь�\"�[B�R�P���h��������wV��{�����p/ٶD$u�L��*��6ޭ��jY��A�-�,��6�D�s$7H�\n���\n0���J�K�߉5m�Vr���6�{��K�K��#q����G8*��>��N׽��-�%o�1�d���L�p��(|�de��OB�f���~o�N�c����%�K�9�v�����5x�A����5�5��G{���@�p��r�O�c�q�\0��n�g�-P�$��Q{4�rȡ�Qm�X�|�%\0�@�3\\�_	��i�C��
�>o��������ݳvq��(���>�������Z�ޥ����\0�|�x�����gA�$��m�-G]���}B��K�[/��#�b�\'#1���sr]wG��>n�c��>ź��s�y|��ܽ3���W�<Eg}cys<�Z��[��^a���X��N6�y,rx#\'�|�Ӵ�4�Nﴝ?�<Mshe�Xȋqز)
INSERT INTO resource_update VALUES("105","4","KARTHIKEYAN","8","25","5","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`
INSERT INTO resource_update VALUES("106","4","KARTHIKEYAN","8","25","5","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0,,\0\0��	LPhotoshop 3.0\08BIM�\nResolution\0\0\0\0,\0\0\0\0,\0\0\0\08BIM
INSERT INTO resource_update VALUES("107","4","pentamine","8","25","5","MBBS","Fulltime","",",,,,,,,",",,,,,,,","2014-08-13","2014-08-14","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`
INSERT INTO resource_update VALUES("108","4","pentamine","8","25","6","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-15","2014-08-14","����\0JFIF\0\0`\0`\0\0��
|����cIn�q=�8�=�6��v�L��V�զ)[P~���­r�H���ʇ��%�CA�+�>�U�G�Z��!Zf?OO�\0U���6�y!����*������KA�N�P�!_FV���رX_����n�O���9V��\n�mO�\n��	�旛�-��!���oo�7O���^>�u<~��*���v=��^x��1����r4��넔S`���Wt�������\n⇪��[-�k���v�ژ�.h=��)�������Zp#�]Zm�aV��C�_���QS�\0Z[@A��,�JxAM�v۾*g	��PG�n��wS\"R빚�ے��M��#���.ؓ�qS�F�/�6�dC����hi+5�z��5������pMO���ݩ���}�dc�M�aU\0��-�\"#����ҾFVY#��� ��F]���ݑ�!T(pc_s�kf�.AO�}�QL�A��OL$�K�<p��q�kF���v�!IO|$�VZ!9���
N����	�h��Fg��QSN��i��-��Ku_I��oZnDÊ����*T!*Nđ���&(2�\"K���_�\'m��<�T��|,�es�=<|;cV���u��?��r�S��Bq��F��s���^���Dh����$�@6� 2${�K�P>��-vr�S��f@��{��i x�&bA_o�3نXѴ���0c����(v�H�`��:�#G\'v�\0|�$����z�Q�*+Ҧ�O��FE��\"7���ۆf\n����d���ԩ=���f�n�1�w���p��V��2�AKFۙ��O\\<t�Z&H�?�h@�z�r�Wa�T��8Ք�S��K%eJ�n�Y�^ٙ�h���\nק_�[A��)�n+��K�x�P��ՂQ�(e1_s*IFU�bNF!�$ķB����і�A��:u%mt�
INSERT INTO resource_update VALUES("109","4","KARTHIKEYAN","8","25","6","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-15","2014-08-14","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`
INSERT INTO resource_update VALUES("110","5","pentamine","8","25","5","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0,,\0\0��	LPhotoshop 3.0\08BIM�\nResolution\0\0\0\0,\0\0\0\0,\0\0\0\08BIM
INSERT INTO resource_update VALUES("111","5","pentamine","8","25","5","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0,,\0\0��	LPhotoshop 3.0\08BIM�\nResolution\0\0\0\0,\0\0\0\0,\0\0\0\08BIM
INSERT INTO resource_update VALUES("112","5","pentamine","8","25","5","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0,,\0\0��	LPhotoshop 3.0\08BIM�\nResolution\0\0\0\0,\0\0\0\0,\0\0\0\08BIM
INSERT INTO resource_update VALUES("113","5","pentamine","8","25","5","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0,,\0\0��	LPhotoshop 3.0\08BIM�\nResolution\0\0\0\0,\0\0\0\0,\0\0\0\08BIM
INSERT INTO resource_update VALUES("114","4","pentamine","7","24","6","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`
INSERT INTO resource_update VALUES("115","4","KARTHIKEYAN","6","23","7","DNB","Fulltime","",",,,,,,,",",,,,,,,","2014-08-14","2014-08-14","����\0JFIF\0\0`\0`\0\0��
|����cIn�q=�8�=�6��v�L��V�զ)[P~���­r�H���ʇ��%�CA�+�>�U�G�Z��!Zf?OO�\0U���6�y!����*������KA�N�P�!_FV���رX_����n�O���9V��\n�mO�\n��	�旛�-��!���oo�7O���^>�u<~��*���v=��^x��1����r4��넔S`���Wt�������\n⇪��[-�k���v�ژ�.h=��)�������Zp#�]Zm�aV��C�_���QS�\0Z[@A��,�JxAM�v۾*g	��PG�n��wS\"R빚�ے��M��#���.ؓ�qS�F�/�6�dC����hi+5�z��5������pMO���ݩ���}�dc�M�aU\0��-�\"#����ҾFVY#��� ��F]���ݑ�!T(pc_s�kf�.AO�}�QL�A��OL$�K�<p��q�kF���v�!IO|$�VZ!9���
N����	�h��Fg��QSN��i��-��Ku_I��oZnDÊ����*T!*Nđ���&(2�\"K���_�\'m��<�T��|,�es�=<|;cV���u��?��r�S��Bq��F��s���^���Dh����$�@6� 2${�K�P>��-vr�S��f@��{��i x�&bA_o�3نXѴ���0c����(v�H�`��:�#G\'v�\0|�$����z�Q�*+Ҧ�O��FE��\"7���ۆf\n����d���ԩ=���f�n�1�w���p��V��2�AKFۙ��O\\<t�Z&H�?�h@�z�r�Wa�T��8Ք�S��K%eJ�n�Y�^ٙ�h���\nק_�[A��)�n+��K�x�P��ՂQ�(e1_s*IFU�bNF!�$ķB����і�A��:u%mt�
INSERT INTO resource_update VALUES("116","4","asdf","8","25","6","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-18","2014-08-18","","1234567891","4567894561","a@gmail.co.in","ac@g.io.in","2014-08-18","0","0");
INSERT INTO resource_update VALUES("117","4","asdfasdf","7","26","6","DNB","Visiting","2",",09:32,,,,,,",",08:24,,,,,,","2014-08-22","2014-08-22","����\0JFIF\0\0`\0`\0\0��.Photoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
/��i�r�´p?��\0�*��.g������F�To���#`dw��\0�V��� 
INSERT INTO resource_update VALUES("118","4","asdfasdf","8","25","6","DNB","Visiting","2",",2014-08-22 12:00:17,,,,,,",",2014-08-22 12:00:22,,,,,,","2014-08-22","2014-08-22","","asdf","4534523452","aadsf@gmail.com","","2014-08-22","0","0");
INSERT INTO resource_update VALUES("119","4","asdfasd","7","24","6","DNB","Visiting","2",",12:04,,12:04,,,12:04,",",12:04,,12:04,,,12:04,","2014-08-22","2014-08-22","����\0JFIF\0\0`\0`\0\0��.Photoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
/��i�r�´p?��\0�*��.g������F�To���#`dw��\0�V��� 
INSERT INTO resource_update VALUES("120","4","asdfas","8","27","6","DNB","Fulltime","",",,,,,,,",",,,,,,,","2014-08-01","2014-08-22","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`
INSERT INTO resource_update VALUES("121","5","asdfa","6","23","6","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-21","2014-08-22","","1234123412343124","3143241234","aadsf@gmail.com","","2014-08-19","0","2");
INSERT INTO resource_update VALUES("122","4","zxfvxzgfsd","8","27","5","DNB","Fulltime","",",,,,,,,",",,,,,,,","2014-08-22","2014-08-22","","asdfasdf","3143241234","aadsf@gmail.com","","2014-08-22","1","3");
INSERT INTO resource_update VALUES("123","4","asdfasd","8","27","6","Fellowship","Fulltime","",",,,,,,,",",,,,,,,","2014-08-22","2014-08-22","����\0JFIF\0\0`\0`\0\0��JPhotoshop 3.0\08BIM�\nResolution\0\0\0\0\0`\0\0\0\0\0`\0\0\0\08BIM
s���t�HB�c��<���k���*�$	���+��q��`$˝�%;�_;ƿw��1 �����w��K�e���OL|�����f@:���I��IA���\'&)�j���R-&\n	_t��\'t����mD��\nU�0t�D]�i��s��i?�����$D�>��ȇ�i%�^t��P��6�w�d�z�@�˱�:���L)3On�@c-h�A*{�:|>_���RH�H㤃>e�\0�b�\'��6�@�ejv��i� }�}�\0�۲y?Hjxׄ�tM.�����Qd8��t��#�xE�F�Dj��).ΉK��RQ\'C��c\0������타���\'���}#<�*2w���b[/#�I�6gC>Z쨽�&A�\0r����~,� ָ7��hGk���<�j�8A��qc�iv���;��t5Hf`