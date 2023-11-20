class StringLengthExceededError(ValueError):
    pass

def revisar_largo_str(string, largo_maximo):
    if len(string) > largo_maximo:
        raise StringLengthExceededError(f"String '{string}' exceeds the declared maximum length | string length: {len(string)} | max length: ({string})")
    return string