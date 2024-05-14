<?php

declare(strict_types=1);

namespace SergeyZatulivetrov\TinkoffAcquiring\Entity\Receipt;

/**
 * ClientInfo
 */
class ClientInfo
{
    /**
     * @param string|null $birthdate Дата рождения клиента в формате ДД.ММ.ГГГГ
     * @param string|null $citizenship Числовой код страны, гражданином которой является клиент.
     * Код страны указывается в соответствии с Общероссийским классификатором стран мира ОКСМ
     * @param string|null $documentCode Числовой код вида документа, удостоверяющего личность.
     * Может принимать только значения:
     * - 21  Паспорт гражданина Российской Федерации,
     * - 22  Паспорт гражданина Российской Федерации, дипломатический паспорт, служебный паспорт,
     * удостоверяющие личность гражданина Российской Федерации за пределами Российской Федерации,
     * - 26  Временное удостоверение личности гражданина Российской Федерации, выдаваемое на период
     * оформления паспорта гражданина Российской Федерации,
     * - 27  Свидетельство о рождении гражданина Российской Федерации(для граждан Российской Федерации
     * в возрасте до 14 лет),
     * - 28  Иные документы, признаваемые документами, удостоверяющими личность гражданина Российской Федерации
     * в соответствии с законодательством Российской Федерации,
     * - 31  Паспорт иностранного гражданина,
     * - 32  Иные документы, признаваемые документами, удостоверяющими личность иностранного гражданина в соответствии
     * с законодательством Российской Федерации и международным договором Российской Федерации,
     * - 33  Документ, выданный иностранным государством и признаваемый в соответствии с международным договором
     * Российской Федерации в качестве документа, удостоверяющего личность лица безгражданства,
     * - 34  Вид на жительство(для лиц без гражданства),
     * - 35  Разрешение на временное проживание(для лиц без гражданства),
     * - 36  Свидетельство о рассмотрении ходатайства о признании лица без гражданства беженцем на территории
     * Российской Федерации по существу,
     * - 37  Удостоверение беженца,
     * - 38  Иные документы, признаваемые документами, удостоверяющими личность лиц без гражданства в соответствии
     * с законодательством Российской Федерации и международным договором Российской Федерации,
     * - 40  Документ, удостоверяющий личность лица, не имеющего действительного документа, удостоверяющего личность,
     * на период рассмотрения заявления о признании гражданином Российской Федерации или о приеме в гражданство
     * Российской Федерации.
     * @param string|null $documentData Реквизиты документа, удостоверяющего личность(например: серия и номер паспорта)
     * @param string|null $address Адрес клиента, грузополучателя
     */
    public function __construct(
        public readonly ?string $birthdate,
        public readonly ?string $citizenship,
        public readonly ?string $documentCode,
        public readonly ?string $documentData,
        public readonly ?string $address,
    ) {
    }
}
